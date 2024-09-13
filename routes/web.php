<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $num = session('num');
    return view('welcome')->with('num', $num);
});
