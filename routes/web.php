<?php

use App\Livewire\Components\TestButton;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Index;
use App\Livewire\Pages\Login;
use App\Livewire\Pages\Register;
use App\Livewire\Pages\TeacherDashboard;
use Illuminate\Support\Facades\Route;


Route::get('/', Index::class)->middleware('auth');
Route::get('/dashboard', Dashboard::class)->middleware('auth');
Route::get('/teacher', TeacherDashboard::class)->middleware( 'can:teacher');
Route::get('/test', TestButton::class);
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
