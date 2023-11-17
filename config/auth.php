<?php
return [

'defaults' => [
    'guard' => 'web',
    'passwords' => 'users',
],

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
],

'passwords' => [
    'users' => [
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
    ],
],

'password_timeout' => 10800,

/*
|--------------------------------------------------------------------------
| Password Confirmation
|--------------------------------------------------------------------------
|
| This configuration controls the password confirmation experience for
| the user. By default, the user is required to enter their password for
| confirmation during sensitive operations such as transferring funds.
|
*/

'password_confirmation' => [
    'required' => true,
    'label' => 'Veuillez confirmer votre mot de passe',
    'confirm_text' => 'Confirmez votre mot de passe pour continuer',
    'cancel_text' => 'Annuler',
    'expire' => 60,
],

];
