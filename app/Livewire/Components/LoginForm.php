<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginForm extends Component
{
    #[Validate('required', message: "Student Number is Required")]
    public $s_number;

    #[Validate('required', message: "Password is Required")]
    public $password;

    public $status = "Failed";

    public function login(){
        $this->validate();

        $credentials = [
            's_number' => $this->s_number,
            'password' => $this->password,
        ];

//        $this->addError('password', 'Invalid Student Number or Password');

        if(Auth::attempt($credentials)){
            return redirect('/dashboard');
        }
        return back()->withErrors(['password' => 'Invalid Student Number or Password']);
    }

    public function render()
    {
        return view('livewire.components.login-form');
    }
}
