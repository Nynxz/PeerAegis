<?php

namespace App\Livewire;

use Livewire\Component;

class TestButton extends Component
{
    public $count = 1;

    public function mount(){
        $this->count = session('count') ?? 0;
    }
    public function increment()
    {
        $this->count++;
        session(['count' => $this->count]);
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.test-button');
    }
}
