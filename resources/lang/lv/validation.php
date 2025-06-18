<?php

return [
    'required' => 'Lauks <i>:attribute</i> ir obligāts.',
    'string' => 'Laukam <i>:attribute</i> jāsatur tekstu.',
    'max' => [
        'string' => 'Lauka <i>:attribute</i> saturs nedrīkst būt garāks par :max rakstzīmēm.',
    ],
    'min' => [
        'string' => 'Lauka <i>:attribute</i> saturam jābūt vismaz :min rakstzīmes garam.',
    ],
    'email' => 'Laukā <i>:attribute</i> jābūt derīgai e-pasta adresei.',
    'unique' => 'Laukā <i>:attribute</i> ievadītā vērtība ir aizņemta.',
    'same' => 'Laukiem <i>:attribute</i> un <i>:other</i> jāsakrīt.',
    'confirmed' => 'Lauka <i>:attribute</i> apstiprinājums nesakrīt.',
    'numeric' => 'Lauka <i>:attribute</i> saturam jābūt skaitlim.',
    'image' => 'Laukā <i>:attribute</i> sniegtajam failam jābūt attēlam.',
    'mimes' => 'Laukā <i>:attribute</i> sniegtajam failam jābūt ar tipu: :values.',
    'exists' => 'Laukā <i>:attribute</i> izvēlētā vērtība nav derīga.',
    'wrong_credentials' => 'Nepareizi ievadīts e-pasts vai parole vai konts neeksistē.',
    'captcha_error' => 'Izpildiet reCAPTCHA, lai turpinātu.',

    'attributes' => [
        'name' => 'vārds',
        'email' => 'e-pasta adrese',
        'password' => 'parole',
        'password_confirmation' => 'paroles apstiprinājums',
        'address' => 'adrese',
        'title' => 'virsraksts',
        'description' => 'apraksts',
        'price' => 'cena',
        'category_id' => 'kategorija',
        'image' => 'attēls',
    ],
];