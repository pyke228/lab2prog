<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/contacts', function () {

    $contacts = [
        'name' => 'Polytech',
        'email' => '@mospolytech.ru',
        'adres' => 'B. Semenovskaya',
        'phone' => '8(495) 423-2323'
    ];

    return view('contacts', ['contacts' => $contacts]);
})->name('contacts');