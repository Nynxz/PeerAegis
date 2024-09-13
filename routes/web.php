<?php

use App\Livewire\Index;
use App\Livewire\TestButton;
use Illuminate\Support\Facades\Route;


Route::get('/', Index::class);
Route::get('/test', TestButton::class);
