<?php

namespace App\Livewire\Observer;

use Livewire\Component;

class Subject extends Component
{
    public $state = '';

    public function updatedState($value)
    {
        $this->dispatch('stateUpdated', $value);
    }

    public function render()
    {
        return view('livewire.observer.subject');
    }
}
