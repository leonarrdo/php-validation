<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/helloworld', function () {
    $teste = 123;
    echo "Hello World";
});
