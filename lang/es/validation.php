<?php

return [
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'password' => [
        'mixed' => 'El campo :attribute debe contener al menos una letra mayúscula y una minúscula.',
        'letters' => 'El campo :attribute debe contener al menos una letra.',
        'numbers' => 'El campo :attribute debe contener al menos un número.',
        'symbols' => 'El campo :attribute debe contener al menos un símbolo.',
        'uncompromised' => 'El :attribute proporcionado se ha visto en una filtración de datos. Por favor elija un :attribute diferente.',
    ],
    'attributes' => [
        'password' => 'contraseña'
    ],
];
