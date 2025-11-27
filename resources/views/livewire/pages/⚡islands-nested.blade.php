<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('Nested Islands - LiveWire 4')] class extends Component {
    public int $level0Count = 0;
    public int $level1Count = 0;
    public int $level2Count = 0;
    public int $level3Count = 0;

    public function incrementLevel0()
    {
        sleep(0.3);
        $this->level0Count++;
    }

    public function incrementLevel1()
    {
        sleep(0.3);
        $this->level1Count++;
    }

    public function incrementLevel2()
    {
        sleep(0.3);
        $this->level2Count++;
    }

    public function incrementLevel3()
    {
        sleep(0.3);
        $this->level3Count++;
    }
}; ?>

<div class="p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Nested Islands</h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Multi-level island nesting with independent updates and cascading modes.
            </p>
        </div>

        <!-- Introduction -->
        <div class="bg-gradient-to-r from-violet-50 to-fuchsia-50 dark:from-violet-900/20 dark:to-fuchsia-900/20 rounded-lg border border-violet-200 dark:border-violet-800 p-6 mb-8">
            <h2 class="text-lg font-semibold text-violet-900 dark:text-violet-100 mb-2">Understanding Nested Islands</h2>
            <p class="text-sm text-violet-800 dark:text-violet-200 mb-3">
                Islands can be nested inside other islands, creating a hierarchy of isolated rendering scopes. Each level can update independently or cascade updates based on the `always` mode.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="p-3 bg-white dark:bg-violet-900/30 rounded-lg">
                    <p class="text-xs font-semibold text-violet-900 dark:text-violet-100 mb-1">Independent Updates</p>
                    <p class="text-xs text-violet-700 dark:text-violet-300">Each level updates on its own</p>
                </div>
                <div class="p-3 bg-white dark:bg-violet-900/30 rounded-lg">
                    <p class="text-xs font-semibold text-violet-900 dark:text-violet-100 mb-1">Cascading Updates</p>
                    <p class="text-xs text-violet-700 dark:text-violet-300">Use `always` to update with parent</p>
                </div>
                <div class="p-3 bg-white dark:bg-violet-900/30 rounded-lg">
                    <p class="text-xs font-semibold text-violet-900 dark:text-violet-100 mb-1">Performance</p>
                    <p class="text-xs text-violet-700 dark:text-violet-300">Only render what changed</p>
                </div>
            </div>
        </div>

        <!-- Single-Level Nesting Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Single-Level Nesting</h2>
            
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                A simple example of one island nested inside a parent component.
            </p>

            <!-- Level 0: Parent Component -->
            <div class="border-4 border-blue-300 dark:border-blue-700 rounded-lg p-6 bg-blue-50 dark:bg-blue-900/10">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                            <h3 class="text-sm font-bold text-blue-900 dark:text-blue-100">Level 0: Parent Component</h3>
                        </div>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">Count: {{ $level0Count }}</p>
                    </div>
                    <flux:button 
                        wire:click="incrementLevel0" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors"
                    >
                        Increment Level 0
                    </flux:button>
                </div>

                <!-- Level 1: Nested Island -->
                @island
                    <div class="border-4 border-emerald-300 dark:border-emerald-700 rounded-lg p-6 bg-emerald-50 dark:bg-emerald-900/10">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-4 h-4 bg-emerald-500 rounded-full"></div>
                                    <h3 class="text-sm font-bold text-emerald-900 dark:text-emerald-100">Level 1: Nested Island</h3>
                                </div>
                                <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">Count: {{ $level1Count }}</p>
                            </div>
                            <flux:button 
                                wire:click="incrementLevel1" 
                                class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-colors"
                            >
                                Increment Level 1
                            </flux:button>
                        </div>
                    </div>
                @endisland
            </div>

            <div class="mt-4 p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg">
                <p class="text-xs text-zinc-600 dark:text-zinc-400">
                    <strong>Behavior:</strong> Clicking "Increment Level 0" updates the parent but NOT the island. 
                    Clicking "Increment Level 1" updates only the island.
                </p>
            </div>
        </div>

        <!-- Multi-Level Nesting Demo (3 Levels Deep) -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Multi-Level Nesting (3 Levels Deep)</h2>
            
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                Islands nested inside islands inside islands! Each level updates independently.
            </p>

            <!-- Level 0: Parent -->
            <div class="border-4 border-indigo-300 dark:border-indigo-700 rounded-lg p-6 bg-indigo-50 dark:bg-indigo-900/10">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2 py-0.5 bg-indigo-600 text-white text-xs font-bold rounded">L0</span>
                            <h3 class="text-sm font-bold text-indigo-900 dark:text-indigo-100">Parent Component</h3>
                        </div>
                        <p class="text-xl font-bold text-indigo-600 dark:text-indigo-400">{{ $level0Count }}</p>
                    </div>
                    <flux:button 
                        wire:click="incrementLevel0" 
                        class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded text-xs font-medium transition-colors"
                    >
                        +1
                    </flux:button>
                </div>

                <!-- Level 1: First Island -->
                @island
                    <div class="border-4 border-purple-300 dark:border-purple-700 rounded-lg p-5 bg-purple-50 dark:bg-purple-900/10">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2 py-0.5 bg-purple-600 text-white text-xs font-bold rounded">L1</span>
                                    <h3 class="text-sm font-bold text-purple-900 dark:text-purple-100">Island Level 1</h3>
                                </div>
                                <p class="text-xl font-bold text-purple-600 dark:text-purple-400">{{ $level1Count }}</p>
                            </div>
                            <flux:button 
                                wire:click="incrementLevel1" 
                                class="px-3 py-1.5 bg-purple-600 hover:bg-purple-700 text-white rounded text-xs font-medium transition-colors"
                            >
                                +1
                            </flux:button>
                        </div>

                        <!-- Level 2: Second Nested Island -->
                        @island
                            <div class="border-4 border-pink-300 dark:border-pink-700 rounded-lg p-4 bg-pink-50 dark:bg-pink-900/10">
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="px-2 py-0.5 bg-pink-600 text-white text-xs font-bold rounded">L2</span>
                                            <h3 class="text-xs font-bold text-pink-900 dark:text-pink-100">Island Level 2</h3>
                                        </div>
                                        <p class="text-lg font-bold text-pink-600 dark:text-pink-400">{{ $level2Count }}</p>
                                    </div>
                                    <flux:button 
                                        wire:click="incrementLevel2" 
                                        class="px-3 py-1.5 bg-pink-600 hover:bg-pink-700 text-white rounded text-xs font-medium transition-colors"
                                    >
                                        +1
                                    </flux:button>
                                </div>

                                <!-- Level 3: Third Nested Island -->
                                @island
                                    <div class="border-4 border-rose-300 dark:border-rose-700 rounded-lg p-3 bg-rose-50 dark:bg-rose-900/10">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="flex items-center gap-2 mb-1">
                                                    <span class="px-2 py-0.5 bg-rose-600 text-white text-xs font-bold rounded">L3</span>
                                                    <h3 class="text-xs font-bold text-rose-900 dark:text-rose-100">Island Level 3</h3>
                                                </div>
                                                <p class="text-base font-bold text-rose-600 dark:text-rose-400">{{ $level3Count }}</p>
                                            </div>
                                            <flux:button 
                                                wire:click="incrementLevel3" 
                                                class="px-2 py-1 bg-rose-600 hover:bg-rose-700 text-white rounded text-xs font-medium transition-colors"
                                            >
                                                +1
                                            </flux:button>
                                        </div>
                                    </div>
                                @endisland
                            </div>
                        @endisland
                    </div>
                @endisland
            </div>

            <div class="mt-4 p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg">
                <p class="text-xs text-zinc-600 dark:text-zinc-400 mb-2">
                    <strong>Test it:</strong> Click any button and observe that only that specific level updates!
                </p>
                <ul class="text-xs text-zinc-600 dark:text-zinc-400 space-y-1 list-disc list-inside">
                    <li>Level 0 button → Only parent updates</li>
                    <li>Level 1 button → Only L1 island updates</li>
                    <li>Level 2 button → Only L2 island updates</li>
                    <li>Level 3 button → Only L3 island updates</li>
                </ul>
            </div>
        </div>

        <!-- Cascading Updates with Always Mode -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Cascading Updates (Always Mode)</h2>
            
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                Using <code class="px-1.5 py-0.5 bg-zinc-100 dark:bg-zinc-700 rounded text-xs">always: true</code> makes child islands update when their parent updates.
            </p>

            <div class="border-4 border-cyan-300 dark:border-cyan-700 rounded-lg p-6 bg-cyan-50 dark:bg-cyan-900/10">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-cyan-900 dark:text-cyan-100 mb-1">Parent Component</h3>
                        <p class="text-xl font-bold text-cyan-600 dark:text-cyan-400">{{ $level0Count }}</p>
                    </div>
                    <flux:button 
                        wire:click="incrementLevel0" 
                        class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg text-sm font-medium transition-colors"
                    >
                        Update Parent
                    </flux:button>
                </div>

                @island(always: true)
                    <div class="border-4 border-teal-300 dark:border-teal-700 rounded-lg p-5 bg-teal-50 dark:bg-teal-900/10">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h3 class="text-sm font-bold text-teal-900 dark:text-teal-100 mb-1">Child Island (always: true)</h3>
                                <p class="text-lg font-bold text-teal-600 dark:text-teal-400">{{ $level1Count }}</p>
                            </div>
                            <flux:button 
                                wire:click="incrementLevel1" 
                                class="px-3 py-1.5 bg-teal-600 hover:bg-teal-700 text-white rounded text-xs font-medium transition-colors"
                            >
                                Update Child
                            </flux:button>
                        </div>

                        @island(always: true)
                            <div class="border-4 border-emerald-300 dark:border-emerald-700 rounded-lg p-4 bg-emerald-50 dark:bg-emerald-900/10">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-xs font-bold text-emerald-900 dark:text-emerald-100 mb-1">Grandchild Island (always: true)</h3>
                                        <p class="text-base font-bold text-emerald-600 dark:text-emerald-400">{{ $level2Count }}</p>
                                    </div>
                                    <flux:button 
                                        wire:click="incrementLevel2" 
                                        class="px-2 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs font-medium transition-colors"
                                    >
                                        Update
                                    </flux:button>
                                </div>
                            </div>
                        @endisland
                    </div>
                @endisland
            </div>

            <div class="mt-4 p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg">
                <p class="text-xs text-zinc-600 dark:text-zinc-400 mb-2">
                    <strong>Cascading behavior:</strong>
                </p>
                <ul class="text-xs text-zinc-600 dark:text-zinc-400 space-y-1 list-disc list-inside">
                    <li>Click "Update Parent" → All three sections update (cascading)</li>
                    <li>Click "Update Child" → Child and Grandchild update</li>
                    <li>Click "Update" (Grandchild) → Only Grandchild updates</li>
                </ul>
            </div>
        </div>

        <!-- Code Examples -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Code Examples</h2>
            
            <div class="space-y-6">
                <!-- Basic Nesting -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Basic Nesting</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>&lt;div&gt;Parent Component&lt;/div&gt;

@island
    &lt;div&gt;Level 1 Island&lt;/div&gt;
    
    @island
        &lt;div&gt;Level 2 Island&lt;/div&gt;
    @endisland
@endisland</code></pre>
                </div>

                <!-- Cascading with Always -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Cascading Updates</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>&lt;div&gt;Parent Component&lt;/div&gt;

@island(always: true)
    &lt;div&gt;Child Island (updates with parent)&lt;/div&gt;
    
    @island(always: true)
        &lt;div&gt;Grandchild Island (updates with parent)&lt;/div&gt;
    @endisland
@endisland</code></pre>
                </div>

                <!-- Mixed Modes -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Mixed Modes</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@island(lazy: true)
    &lt;div&gt;Lazy loaded island&lt;/div&gt;
    
    @island(defer: true)
        &lt;div&gt;Deferred nested island&lt;/div&gt;
        
        @island(always: true)
            &lt;div&gt;Always updates with parent&lt;/div&gt;
        @endisland
    @endisland
@endisland</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
