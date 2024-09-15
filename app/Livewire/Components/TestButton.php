<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TestButton extends Component
{
    public $count = 1;
    public $user;

    public function mount(){
        $this->user = Auth::user();

        // Use different session keys depending on whether the user is logged in
        if ($this->user) {
            $this->count = session('user_count_' . $this->user->id) ?? 0;
        } else {
            $this->count = session('guest_count') ?? 0;
        }
    }
    public function increment()
    {
        $this->count++;

        // Store the count in different session keys depending on login status
        if ($this->user) {
            session(['user_count_' . $this->user->id => $this->count]);
        } else {
            session(['guest_count' => $this->count]);
        }
    }

    public function decrement()
    {
        $this->count--;

        if ($this->user) {
            session(['user_count_' . $this->user->id => $this->count]);
        } else {
            session(['guest_count' => $this->count]);
        }


    }

    public function log()
    {

        // Log the user out and regenerate the session
        Auth::logout();
        redirect('/');
        return;
//        $this->count--;
//        Auth::logout();
//        redirect('/');
//
//        $this->user = Auth::user();
//        dd($this->user);
    }

    public function info()
    {
        $this->user = Auth::user();
        dd($this->user);
    }

    public function infoSS()
    {
        dd(session()->all());
    }
    public function render()
    {
        return view('livewire.components.test-button');
    }
}
