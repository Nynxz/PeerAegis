<?php

namespace App\Livewire\Components;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

    public $status = "Failed";

    public function register()
    {
        $this->validate();

        $credentials = [
            's_number' => $this->s_number,
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
        ];

        User::create($credentials);

        if(Auth::attempt($credentials)){
            return redirect('/dashboard');
        }

        return back()->withErrors(['password' => 'Invalid Student Number or Password']);
    }

    public function render()
    {
        return view('livewire.components.register-form');
    }
}
