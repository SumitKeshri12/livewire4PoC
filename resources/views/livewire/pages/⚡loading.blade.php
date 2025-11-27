<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('Smart Loading Indicators - LiveWire 4')] class extends Component {
    public int $count = 0;

    public function increment()
    {
        sleep(1); // Simulate network delay
        $this->count++;
    }

    public function dispatchLoading()
    {
        sleep(1); // Simulate network delay
        $this->dispatch('trigger-loading');
    }
}; ?>

<div class="p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Smart Loading Indicators</h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Automatic data-loading attributes with cross-component awareness for seamless UX.
            </p>
        </div>

        <!-- Feature Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Basic Loading -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Basic Loading State</h2>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-3">
                            Click the button and watch the <code class="px-1.5 py-0.5 bg-zinc-100 dark:bg-zinc-700 rounded text-xs">data-loading</code> attribute appear automatically.
                        </p>
                        
                        <flux:button 
                            wire:click="increment" 
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors"
                        >
                            Increment Counter
                        </flux:button>
                        
                        <div class="mt-4 p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg">
                            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                Count: <span class="font-bold text-indigo-600 dark:text-indigo-400">{{ $count }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">What Happens:</h3>
                        <ul class="text-xs text-zinc-600 dark:text-zinc-400 space-y-1 list-disc list-inside">
                            <li>Button gets <code class="px-1 py-0.5 bg-zinc-100 dark:bg-zinc-700 rounded">data-loading</code> attribute</li>
                            <li>Opacity reduces to 60%</li>
                            <li>Pointer events disabled</li>
                            <li>Spinning loader appears</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Cross-Component Loading -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Cross-Component Loading</h2>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-3">
                            This button dispatches an event to a child component. Watch the button show loading state even though the child component handles the request!
                        </p>
                        
                        <flux:button 
                            wire:click="dispatchLoading" 
                            class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition-colors"
                        >
                            Dispatch Event
                        </flux:button>
                    </div>

                    <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-3">Child Component</h3>
                        <livewire:components.loading-child />
                    </div>

                    <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                        <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">How It Works:</h3>
                        <ul class="text-xs text-zinc-600 dark:text-zinc-400 space-y-1 list-disc list-inside">
                            <li>Parent button dispatches event</li>
                            <li>Child component listens and processes</li>
                            <li>Parent button automatically shows loading</li>
                            <li>No manual wire:target needed!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visual Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Loading State Variations</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Normal State</p>
                    <flux:button class="w-full px-4 py-2 bg-emerald-600 text-white rounded-lg font-medium">
                        Click Me
                    </flux:button>
                </div>
                
                <div>
                    <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Loading State (Simulated)</p>
                    <flux:button data-loading class="w-full px-4 py-2 bg-emerald-600 text-white rounded-lg font-medium">
                        Click Me
                    </flux:button>
                </div>
                
                <div>
                    <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Custom Loading Text</p>
                    <flux:button wire:click="increment" class="w-full px-4 py-2 bg-emerald-600 text-white rounded-lg font-medium relative">
                        <span wire:loading.remove>Click Me</span>
                        <span wire:loading>Processing...</span>
                    </flux:button>
                </div>
            </div>
        </div>

        <!-- Code Examples -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Code Examples</h2>
            
            <div class="space-y-6">
                <!-- Basic Usage -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Basic Usage</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>&lt;button wire:click="increment"&gt;
    Increment
&lt;/button&gt;

&lt;!-- Automatically gets data-loading attribute during request --&gt;</code></pre>
                </div>

                <!-- CSS Styling -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">CSS Styling</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>[data-loading] {
    opacity: 0.6;
    pointer-events: none;
    position: relative;
}

[data-loading]::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 16px;
    height: 16px;
    margin: -8px 0 0 -8px;
    border: 2px solid transparent;
    border-top-color: currentColor;
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
}</code></pre>
                </div>

                <!-- Cross-Component -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Cross-Component Loading</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>&lt;!-- Parent Component --&gt;
&lt;button wire:click="dispatchLoading"&gt;
    Dispatch Event
&lt;/button&gt;

public function dispatchLoading()
{
    $this-&gt;dispatch('trigger-loading');
}

&lt;!-- Child Component --&gt;
#[On('trigger-loading')]
public function handleEvent()
{
    // Process the event
    // Parent button automatically shows loading!
}</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
