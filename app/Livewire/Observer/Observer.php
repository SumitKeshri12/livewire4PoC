<?php

namespace App\Livewire\Observer;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Log;

class Observer extends Component
{
    public $observedState = 'Waiting for updates...';
    public $updateCount = 0;
    public $name;
    public $lifecycleLog = [];

    public function mount($name = 'Observer')
    {
        $this->name = $name;
        // Lifecycle: Component is being created (Attach phase)
        $this->addLifecycleLog('mounted', 'Observer attached and ready to listen');
        Log::info("Observer '{$this->name}' mounted");
    }

    #[On('stateUpdated')]
    public function updateState($newState)
    {
        $this->observedState = $newState;
        $this->updateCount++;
        $this->addLifecycleLog('updated', "Received state: {$newState}");
    }

    private function addLifecycleLog($event, $message)
    {
        // Keep only last 5 events
        if (count($this->lifecycleLog) >= 5) {
            array_shift($this->lifecycleLog);
        }
        $this->lifecycleLog[] = [
            'event' => $event,
            'message' => $message,
            'time' => now()->format('H:i:s')
        ];
    }

    public function render()
    {
        return view('livewire.observer.observer');
    }

    public function __destruct()
    {
        // Lifecycle: Component is being destroyed (Detach phase)
        // Note: This runs when PHP garbage collects the object
        Log::info("Observer '{$this->name}' destroyed");
    }
}
