<?php

namespace App\Livewire\Components;

use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterForm extends Component
{
    #[Validate('required', message: "Student Number is Required")]
    #[Validate('unique:users', message: "Student Number is Not Unique")]
    public $s_number;

    #[Validate('required', message: "Name is Required")]
    public $name;
    #[Validate('required', message: "Email is Required")]
    public $email;

    #[Validate('required', message: "Password is Required")]
    public $password;

    public function register(): RedirectResponse|Redirector
    {
        $this->validate();

        return LoginController::register([
            's_number' => $this->s_number,
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
        ]);
    }

    public function render(): View
    {
        return view('livewire.components.register-form');
    }
}
