<?php

return [
    'required' => 'The :attribute field is required.',
    'string' => 'The :attribute must be a string.',
    'max' => [
        'string' => 'The :attribute may not be greater than :max characters.',
    ],
    'min' => [
        'string' => 'The :attribute must be at least :min characters.',
    ],
    'email' => 'The :attribute must be a valid email address.',
    'unique' => 'The :attribute has already been taken.',
    'same' => 'The :attribute and :other must match.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'numeric' => 'The :attribute must be a number.',
    'image' => 'The :attribute must be an image.',
    'mimes' => 'The :attribute must be a file of type: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'wrong_credentials' => 'Incorrect email or password or account doesn\'t exist.',
    'captcha_error' => 'Please complete the reCAPTCHA to continue.',

    'attributes' => [
        'name' => 'name',
        'email' => 'email address',
        'password' => 'password',
        'password_confirmation' => 'password confirmation',
        'address' => 'address',
        'title' => 'title',
        'description' => 'description',
        'price' => 'price',
        'category_id' => 'category',
        'image' => 'image',
    ],
];