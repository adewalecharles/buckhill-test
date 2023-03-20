<?php

return [
 /*
    |--------------------------------------------------------------------------
    | JWT hashing Key
    |--------------------------------------------------------------------------
    |
    | This is the secret key that will be used to encode and decode our jwt token
    |
    */

    'public_key' => env('PUBLIC_JWT_KEY'),
    'private_key' => env('PRIVATE_JWT_KEY')
];
