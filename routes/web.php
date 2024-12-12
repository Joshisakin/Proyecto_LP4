<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RouteController as AdminRouteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas públicas
Route::get('/', function () {
    $rutas = \App\Models\Route::available()
        ->orderBy('fecha_salida')
        ->limit(3)
        ->get();
    return view('welcome', compact('rutas'));
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/terminos', function () {
    return view('legal.terminos');
})->name('terminos');

Route::get('/privacidad', function () {
    return view('legal.privacidad');
})->name('privacidad');

Route::post('/newsletter/subscribe', function (Request $request) {
    return back()->with('success', 'Te has suscrito exitosamente al newsletter.');
})->name('newsletter.subscribe');

// Rutas búsqueda y visualización
Route::get('/rutas/search', [RutaController::class, 'search'])->name('rutas.search');
Route::get('/rutas', [RutaController::class, 'index'])->name('rutas.index');
Route::get('/rutas/{route}', [RutaController::class, 'show'])->name('rutas.show');

// Contacto
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');

// Rutas autenticadas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Rutas públicas
    Route::resource('rutas', RutaController::class)->only(['index', 'show']);

    // Rutas para reservaciones
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('/reservations/{reservation}/ticket', [ReservationController::class, 'downloadTicket'])
        ->name('reservations.ticket');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reservations
    Route::resource('reservations', ReservationController::class);
    Route::post('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::delete('/reservations/{reservation}/force', [ReservationController::class, 'forceDestroy'])->name('reservations.force-destroy');

    // Payments
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/{reservation}', [PaymentController::class, 'show'])->name('show');
        Route::post('/{reservation}/process', [PaymentController::class, 'processPayment'])->name('process');
        Route::get('/{reservation}/success', [PaymentController::class, 'success'])->name('success');
        Route::get('/{reservation}/cancel', [PaymentController::class, 'cancel'])->name('cancel');
        Route::get('/history', [PaymentController::class, 'history'])->name('history');

        // PayPal Webhook
        Route::post('/webhook/paypal', [PaymentController::class, 'handlePayPalWebhook'])
            ->name('webhook.paypal')
            ->withoutMiddleware(['csrf']);
    });
});

// Rutas de administración
Route::prefix('admin')->name('admin.')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('rutas', AdminRouteController::class);
    Route::resource('users', UserController::class);
    Route::resource('reservations', AdminReservationController::class);

    // Rutas de reportes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');

    // Rutas de configuración
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
