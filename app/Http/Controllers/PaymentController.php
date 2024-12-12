<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment as PayPalPayment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.client_secret')
            )
        );
        $this->apiContext->setConfig([
            'mode' => config('services.paypal.mode', 'sandbox')
        ]);
    }

    public function processPayment(Request $request, Reservation $reservation)
    {
        try {
            // Validar estado de la reserva
            if ($reservation->estado !== 'pendiente') {
                return back()->withErrors(['error' => 'La reserva no está en estado pendiente']);
            }

            // Validar disponibilidad de asientos
            if ($reservation->ruta->asientos_disponibles < $reservation->cantidad_pasajeros) {
                return back()->withErrors(['error' => 'No hay suficientes asientos disponibles']);
            }

            // Convertir precio a USD (asumiendo que el precio está en PEN)
            $priceInUSD = round($reservation->precio_total / config('services.paypal.exchange_rate'), 2);

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item = new Item();
            $item->setName('Ticket de Transporte Fluvial')
                 ->setCurrency('USD')
                 ->setQuantity(1)
                 ->setPrice($priceInUSD);

            $itemList = new ItemList();
            $itemList->setItems([$item]);

            $details = new Details();
            $details->setSubtotal($priceInUSD);

            $amount = new Amount();
            $amount->setCurrency('USD')
                   ->setTotal($priceInUSD)
                   ->setDetails($details);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                        ->setItemList($itemList)
                        ->setDescription('Pago de ticket de transporte fluvial');

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(route('payments.success', ['reservation' => $reservation->id]))
                         ->setCancelUrl(route('payments.cancel', ['reservation' => $reservation->id]));

            $payment = new PayPalPayment();
            $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions([$transaction]);

            $payment->create($this->apiContext);

            // Crear registro de pago pendiente
            Payment::create([
                'reservation_id' => $reservation->id,
                'user_id' => Auth::id(),
                'monto' => $reservation->precio_total,
                'metodoPago' => 'paypal',
                'estado' => 'pendiente',
                'transaction_id' => $payment->getId()
            ]);

            return redirect()->to($payment->getApprovalLink());

        } catch (PayPalConnectionException $ex) {
            Log::error('PayPal Payment Error: ' . $ex->getMessage());
            return back()->withErrors(['error' => 'Error al procesar el pago: ' . $ex->getMessage()]);
        } catch (\Exception $ex) {
            Log::error('Payment Processing Error: ' . $ex->getMessage());
            return back()->withErrors(['error' => 'Error inesperado al procesar el pago']);
        }
    }

    public function success(Request $request, Reservation $reservation)
    {
        try {
            $paymentId = $request->input('paymentId');
            $payerId = $request->input('PayerID');

            $payment = PayPalPayment::get($paymentId, $this->apiContext);

            $execution = new \PayPal\Api\PaymentExecution();
            $execution->setPayerId($payerId);

            $result = $payment->execute($execution, $this->apiContext);

            // Actualizar estado de pago
            $paymentRecord = Payment::where('transaction_id', $paymentId)->first();
            if ($paymentRecord) {
                $paymentRecord->update([
                    'estado' => 'completado',
                    'transaction_id' => $result->getId()
                ]);

                // Confirmar reserva
                $reservation->update(['estado' => 'confirmado']);
                $reservation->ruta->decrement('asientos_disponibles', $reservation->cantidad_pasajeros);
            }

            return redirect()->route('reservations.show', $reservation)
                ->with('success', 'Pago realizado exitosamente');

        } catch (\Exception $ex) {
            Log::error('PayPal Payment Verification Error: ' . $ex->getMessage());
            return redirect()->route('reservations.show', $reservation)
                ->withErrors(['error' => 'Error al verificar el pago']);
        }
    }

    public function cancel(Reservation $reservation)
    {
        // Actualizar estado de pago y reserva
        $paymentRecord = Payment::where('reservation_id', $reservation->id)
            ->where('estado', 'pendiente')
            ->first();
            
        if ($paymentRecord) {
            $paymentRecord->update(['estado' => 'cancelado']);
        }

        $reservation->update(['estado' => 'cancelado']);

        return redirect()->route('reservations.show', $reservation)
            ->with('info', 'Pago cancelado');
    }

    public function show(Reservation $reservation)
    {
        // Ensure the reservation belongs to the authenticated user
        $this->authorize('view', $reservation);

        return view('payments.show', compact('reservation'));
    }

    public function successView(Reservation $reservation)
    {
        // Ensure the reservation belongs to the authenticated user
        $this->authorize('view', $reservation);

        return view('payments.success', compact('reservation'));
    }

    public function cancelView(Reservation $reservation)
    {
        // Ensure the reservation belongs to the authenticated user
        $this->authorize('view', $reservation);

        return view('payments.cancel', compact('reservation'));
    }

    public function history()
    {
        $payments = Payment::where('user_id', Auth::id())
            ->with(['reservation.ruta'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('payments.history', compact('payments'));
    }

    public function handlePayPalWebhook(Request $request)
    {
        $payload = $request->all();
        Log::info('PayPal Webhook received', $payload);

        try {
            $event = $payload['event_type'] ?? null;

            switch ($event) {
                case 'PAYMENT.CAPTURE.COMPLETED':
                    $payment = Payment::where('transaction_id', $payload['resource']['id'])->first();
                    if ($payment) {
                        $payment->update(['estado' => 'completado']);
                        $payment->reservation->update(['estado' => 'confirmado']);
                    }
                    break;

                case 'PAYMENT.CAPTURE.DENIED':
                case 'PAYMENT.CAPTURE.DECLINED':
                    $payment = Payment::where('transaction_id', $payload['resource']['id'])->first();
                    if ($payment) {
                        $payment->update(['estado' => 'fallido']);
                        $payment->reservation->update(['estado' => 'cancelado']);
                        // Restaurar asientos disponibles
                        $payment->reservation->ruta->increment('asientos_disponibles', $payment->reservation->cantidad_pasajeros);
                    }
                    break;
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('PayPal Webhook Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
