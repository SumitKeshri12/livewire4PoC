<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('Advanced Islands - LiveWire 4')] class extends Component {
    public array $items = [];
    public int $namedCount = 0;

    public function mount()
    {
        $this->items = ['Initial Item'];
    }

    public function addItem()
    {
        sleep(0.5);
        $newItem = 'Item ' . (count($this->items) + 1);
        
        // Imperatively render the island with just the new item
        $this->renderIsland('items', mode: 'append', with: [
            'items' => [$newItem]
        ]);
        
        // Add to the actual array
        $this->items[] = $newItem;
    }

    public function streamItem()
    {
        sleep(1);
        $newItem = 'Streamed Item ' . (count($this->items) + 1);
        
        // Stream the island with the new item
        $this->streamIsland('items', mode: 'append', with: [
            'items' => [$newItem]
        ]);
        
        $this->items[] = $newItem;
    }

    public function incrementNamed()
    {
        sleep(0.5);
        $this->namedCount++;
    }
}; ?>

<div class="p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Advanced Islands</h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Named islands, imperative rendering, streaming, and append/prepend modes.
            </p>
        </div>

        <!-- Named Islands Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Named Islands (Linked Updates)</h2>
            
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                Islands with the same name update together. Click the button to see both islands update simultaneously!
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                @island(name: 'counter')
                    <div class="border-2 border-dashed border-indigo-500 rounded-lg p-4 bg-indigo-50 dark:bg-indigo-900/10">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                            <h3 class="text-sm font-semibold text-indigo-900 dark:text-indigo-100">Island 1</h3>
                        </div>
                        <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $namedCount }}</p>
                    </div>
                @endisland

                <div class="flex items-center justify-center">
                    <flux:button wire:click="incrementNamed" variant="primary" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors">Increment Both</flux:button>
                </div>

                @island(name: 'counter')
                    <div class="border-2 border-dashed border-indigo-500 rounded-lg p-4 bg-indigo-50 dark:bg-indigo-900/10">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-3 h-3 bg-indigo-500 rounded-full"></div>
                            <h3 class="text-sm font-semibold text-indigo-900 dark:text-indigo-100">Island 2</h3>
                        </div>
                        <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ $namedCount }}</p>
                    </div>
                @endisland
            </div>

            <div class="p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg">
                <p class="text-xs text-zinc-600 dark:text-zinc-400">
                    <strong>How it works:</strong> Both islands have <code class="px-1.5 py-0.5 bg-zinc-200 dark:bg-zinc-700 rounded">name: 'counter'</code>, 
                    so they're linked and update together when any action targets them.
                </p>
            </div>
        </div>

        <!-- Imperative Rendering Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Imperative Rendering (Append Mode)</h2>
            
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                Imperatively render an island with custom data using <code class="px-1.5 py-0.5 bg-zinc-100 dark:bg-zinc-700 rounded text-xs">$this->renderIsland()</code>. 
                This example appends new items without re-rendering the entire list!
            </p>

            <div class="flex gap-3 mb-4">
                <flux:button wire:click="addItem" variant="primary">
                    Add Item (Append)
                </flux:button>
                <flux:button wire:click="streamItem" variant="primary">
                    Stream Item (Append)
                </flux:button>
            </div>

            @island(name: 'items')
                <div class="space-y-2">
                    @foreach($items as $index => $item)
                        <div class="p-3 bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-200 dark:border-emerald-800 rounded-lg">
                            <p class="text-sm font-medium text-emerald-900 dark:text-emerald-100">{{ $item }}</p>
                            <p class="text-xs text-emerald-600 dark:text-emerald-400">Index: {{ $index }}</p>
                        </div>
                    @endforeach
                </div>
            @endisland

            <div class="mt-4 p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg">
                <p class="text-xs text-zinc-600 dark:text-zinc-400 mb-2">
                    <strong>What's happening:</strong>
                </p>
                <ul class="text-xs text-zinc-600 dark:text-zinc-400 space-y-1 list-disc list-inside">
                    <li>"Add Item" uses <code class="px-1 py-0.5 bg-zinc-200 dark:bg-zinc-700 rounded">renderIsland()</code> to append instantly</li>
                    <li>"Stream Item" uses <code class="px-1 py-0.5 bg-zinc-200 dark:bg-zinc-700 rounded">streamIsland()</code> to append with streaming</li>
                    <li>Only the new item is rendered and appended to the DOM</li>
                    <li>Existing items are NOT re-rendered!</li>
                </ul>
            </div>
        </div>

        <!-- Skip Mode Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Skip Mode Island</h2>
            
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                Skip mode islands don't render with the page - they only render when explicitly targeted imperatively.
            </p>

            <div class="p-4 bg-amber-50 dark:bg-amber-900/10 border border-amber-200 dark:border-amber-800 rounded-lg">
                <p class="text-sm text-amber-900 dark:text-amber-100 mb-2">
                    <strong>Use Case:</strong> Perfect for modals, dropdowns, or content that should only render on-demand.
                </p>
                <p class="text-xs text-amber-700 dark:text-amber-300">
                    The island exists in the DOM as a placeholder but doesn't render until you call <code class="px-1 py-0.5 bg-amber-200 dark:bg-amber-800 rounded">renderIsland()</code>.
                </p>
            </div>

            @island(skip: true, name: 'skipped')
                <div class="mt-4 p-4 bg-purple-50 dark:bg-purple-900/10 border-2 border-dashed border-purple-500 rounded-lg">
                    <p class="text-sm font-medium text-purple-900 dark:text-purple-100">
                        This island was rendered imperatively!
                    </p>
                    <p class="text-xs text-purple-700 dark:text-purple-300 mt-1">
                        Rendered at: {{ now()->format('H:i:s') }}
                    </p>
                </div>
            @endisland
        </div>

        <!-- Append vs Prepend Modes -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Append vs Prepend Modes</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Append Example -->
                <div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-white mb-3">Append Mode</h3>
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800 rounded-lg">
                        <p class="text-xs text-blue-700 dark:text-blue-300 mb-2">New content is added to the end</p>
                        <div class="space-y-1">
                            <div class="p-2 bg-white dark:bg-blue-900/20 rounded text-xs">Existing Item 1</div>
                            <div class="p-2 bg-white dark:bg-blue-900/20 rounded text-xs">Existing Item 2</div>
                            <div class="p-2 bg-blue-200 dark:bg-blue-700 rounded text-xs font-bold">← New Item (Appended)</div>
                        </div>
                    </div>
                </div>

                <!-- Prepend Example -->
                <div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-white mb-3">Prepend Mode</h3>
                    <div class="p-4 bg-pink-50 dark:bg-pink-900/10 border border-pink-200 dark:border-pink-800 rounded-lg">
                        <p class="text-xs text-pink-700 dark:text-pink-300 mb-2">New content is added to the beginning</p>
                        <div class="space-y-1">
                            <div class="p-2 bg-pink-200 dark:bg-pink-700 rounded text-xs font-bold">← New Item (Prepended)</div>
                            <div class="p-2 bg-white dark:bg-pink-900/20 rounded text-xs">Existing Item 1</div>
                            <div class="p-2 bg-white dark:bg-pink-900/20 rounded text-xs">Existing Item 2</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Code Examples -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Code Examples</h2>
            
            <div class="space-y-6">
                <!-- Named Islands -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Named Islands</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs">
                        <code>
                            @island(name: 'counter')
                                <div>{{ $namedCount }}</div>
                            @endisland

                            @island(name: 'counter')
                                <div>{{ $namedCount }}</div>
                            @endisland
                        </code>
                    </pre>
                </div>

                <!-- Imperative Rendering -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Imperative Rendering (Append)</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs">
                        <code>
                            public function addItem()
                            {
                                $newItem = 'New Item';
                                
                                // Render island with custom data in append mode
                                $this->renderIsland('items', mode: 'append', with: [
                                    'items' => [$newItem]
                                ]);
                                
                                $this->items[] = $newItem;
                            }

                            @island(name: 'items')
                                @foreach($items as $item)
                                    <div>{{ $item }}</div>
                                @endforeach
                            @endisland
                        </code>
                    </pre>
                </div>

                <!-- Streaming -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Island Streaming</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs">
                        <code>
                            public function streamItem()
                            {
                                sleep(1); // Simulate delay
                                
                                $this->streamIsland('items', mode: 'append', with: [
                                    'items' => [$newItem]
                                ]);
                            }

                            @island(name: 'items')
                                @foreach($items as $item)
                                    <div>{{ $item }}</div>
                                @endforeach
                            @endisland
                        </code>
                    </pre>
                </div>

                <!-- Skip Mode -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Skip Mode</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs">
                        <code>
                            @island(skip: true, name: 'modal')
                                <div>
                                    <!-- Only renders when explicitly called -->
                                </div>
                            @endisland

                            // Render it imperatively
                            $this->renderIsland('modal');
                        </code>
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>
