<?php

namespace App\Livewire\Components;

use App\Http\Controllers\LoginController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginForm extends Component
{
    #[Validate('required', message: "Student Number is Required")]
    public $s_number;

    #[Validate('required', message: "Password is Required")]
    public $password;

    public function login(): RedirectResponse|Redirector {
        $this->validate();
        $this->addError('password', 'Invalid Student Number or Password');
        return LoginController::login([
            's_number' => $this->s_number,
            'password' => $this->password,
        ]);
    }

    public function render(): View
    {
        return view('livewire.components.login-form');
    }
}
