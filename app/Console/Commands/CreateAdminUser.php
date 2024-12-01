<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'hacer:admin {email}';
    protected $description = 'Convertir un usuario en administrador';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("No se encontró usuario con el email: {$email}");
            return 1;
        }

        $user->es_admin = true;
        $user->save();

        $this->info("¡El usuario {$email} ahora es administrador!");
        return 0;
    }
}
