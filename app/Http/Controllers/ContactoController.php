<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;

class ContactoController extends Controller
{
    public function index()
    {
        return view('contacto');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Por favor ingrese un correo electrónico válido',
            'subject.required' => 'El asunto es obligatorio',
            'message.required' => 'El mensaje es obligatorio',
        ]);

        // Aquí puedes agregar la lógica para enviar el correo
        // Por ejemplo:
        // Mail::to('info@amazonriver.com')->send(new ContactoMail($request->all()));

        return back()->with('success', 'Gracias por contactarnos. Te responderemos pronto.');
    }
}
