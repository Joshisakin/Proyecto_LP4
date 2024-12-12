<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => Cache::get('site_name', 'Sistema de Reservas'),
            'contact_email' => Cache::get('contact_email', 'contacto@empresa.com'),
            'phone' => Cache::get('phone', '+51 999 999 999'),
            'address' => Cache::get('address', 'Av. Principal 123'),
            'social_media' => [
                'facebook' => Cache::get('social_facebook', ''),
                'twitter' => Cache::get('social_twitter', ''),
                'instagram' => Cache::get('social_instagram', ''),
            ],
            'payment_methods' => [
                'paypal' => Cache::get('payment_paypal', true),
                'credit_card' => Cache::get('payment_credit_card', true),
                'bank_transfer' => Cache::get('payment_bank_transfer', true),
            ],
            'booking_settings' => [
                'max_passengers' => Cache::get('booking_max_passengers', 10),
                'advance_days' => Cache::get('booking_advance_days', 30),
                'cancellation_hours' => Cache::get('booking_cancellation_hours', 24),
            ],
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:100',
            'contact_email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:200',
            'social_facebook' => 'nullable|url|max:200',
            'social_twitter' => 'nullable|url|max:200',
            'social_instagram' => 'nullable|url|max:200',
            'payment_paypal' => 'boolean',
            'payment_credit_card' => 'boolean',
            'payment_bank_transfer' => 'boolean',
            'booking_max_passengers' => 'required|integer|min:1|max:50',
            'booking_advance_days' => 'required|integer|min:1|max:90',
            'booking_cancellation_hours' => 'required|integer|min:1|max:72',
        ]);

        // Guardar configuraciones en cache
        foreach ($validated as $key => $value) {
            Cache::put($key, $value, now()->addYear());
        }

        // Guardar logo si se ha subido
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('public/settings');
            Cache::put('site_logo', Storage::url($path), now()->addYear());
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Configuraciones actualizadas exitosamente');
    }
}
