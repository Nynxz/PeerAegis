<?php

use App\Livewire\Components\TestButton;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Index;
use App\Livewire\Pages\Login;
use App\Livewire\Pages\Register;
use App\Livewire\Pages\TeacherDashboard;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;


Route::get('/',  function(){
    if(Gate::check('teacher')){
        return redirect('/teacher');
    } else {
        return redirect('/student');
    }
})->middleware('auth');

Route::get('/dashboard', function(){
    if(Gate::check('teacher')){
        return redirect('/teacher');
    } else {
        return redirect('/student');
    }
})->middleware('auth');
Route::get('/teacher', TeacherDashboard::class)->middleware('auth', 'can:teacher');
Route::get('/student', Dashboard::class)->middleware('auth');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
