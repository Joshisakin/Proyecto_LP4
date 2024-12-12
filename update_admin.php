<?php $user = \App\Models\User::where('email', 'admin@admin.com')->first(); if($user) { $user->role = 'admin'; $user->save(); echo 'Usuario actualizado'; } else { echo 'Usuario no encontrado'; }
