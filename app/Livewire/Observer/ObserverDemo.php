<?php

namespace App\Livewire\Observer;

use Livewire\Component;
use Livewire\Attributes\Layout;

class ObserverDemo extends Component
{
    #[Layout('layouts.app')] 
    public function render()
    {
        return view('livewire.observer.observer-demo');
    }
}
