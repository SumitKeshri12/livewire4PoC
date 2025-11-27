<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    public int $eventCount = 0;

    #[On('trigger-loading')]
    public function handleEvent()
    {
        sleep(1); // Simulate processing
        $this->eventCount++;
    }
}; ?>

<div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-200 dark:border-purple-800">
    <p class="text-sm text-purple-900 dark:text-purple-100 font-medium mb-2">
        Child Component Status
    </p>
    <p class="text-xs text-purple-700 dark:text-purple-300">
        Events Received: <span class="font-bold">{{ $eventCount }}</span>
    </p>
    <p class="text-xs text-purple-600 dark:text-purple-400 mt-2">
        This component listens to 'trigger-loading' event
    </p>
</div>
