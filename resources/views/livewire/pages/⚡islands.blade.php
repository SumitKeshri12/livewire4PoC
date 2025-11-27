<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('Basic Islands - LiveWire 4')] class extends Component {
    public int $parentCount = 0;
    public int $islandCount = 0;

    public function incrementParent()
    {
        sleep(0.5);
        $this->parentCount++;
    }

    public function incrementIsland()
    {
        sleep(0.5);
        $this->islandCount++;
    }

    public function incrementBoth()
    {
        sleep(0.5);
        $this->parentCount++;
        $this->islandCount++;
    }
}; ?>

<div class="p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Basic Islands</h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Isolate parts of your view with lazy, defer, and always modes for targeted updates.
            </p>
        </div>

        <!-- Introduction -->
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-lg border border-indigo-200 dark:border-indigo-800 p-6 mb-8">
            <h2 class="text-lg font-semibold text-indigo-900 dark:text-indigo-100 mb-2">What are Islands?</h2>
            <p class="text-sm text-indigo-800 dark:text-indigo-200 mb-3">
                Islands allow you to isolate parts of your component's view so they only re-render when explicitly targeted. 
                This enables highly performant, granular updates without re-rendering the entire component.
            </p>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 bg-white dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-xs font-medium rounded-full">
                    Lazy Loading
                </span>
                <span class="px-3 py-1 bg-white dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-xs font-medium rounded-full">
                    Deferred Loading
                </span>
                <span class="px-3 py-1 bg-white dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-xs font-medium rounded-full">
                    Targeted Updates
                </span>
                <span class="px-3 py-1 bg-white dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 text-xs font-medium rounded-full">
                    Independent Rendering
                </span>
            </div>
        </div>

        <!-- Default Island Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Default Island Behavior</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Parent Section -->
                <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 bg-blue-50 dark:bg-blue-900/10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <h3 class="text-sm font-semibold text-blue-900 dark:text-blue-100">Parent Component</h3>
                    </div>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-3">{{ $parentCount }}</p>
                    <flux:button wire:click="incrementParent" variant="primary" class="w-full">
                        Increment Parent Only
                    </flux:button>
                </div>

                <!-- Island Section -->
                @island
                    <div class="border-2 border-dashed border-emerald-500 rounded-lg p-4 bg-emerald-50 dark:bg-emerald-900/10">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-semibold text-emerald-900 dark:text-emerald-100">Island (Default)</h3>
                        </div>
                        <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mb-3">{{ $islandCount }}</p>
                        <flux:button wire:click="incrementIsland" variant="primary" class="w-full">
                            Increment Island Only
                        </flux:button>
                    </div>
                @endisland
            </div>

            <div class="mt-4 p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg">
                <p class="text-xs text-zinc-600 dark:text-zinc-400 mb-2">
                    <strong>Try it:</strong> Click each button and observe:
                </p>
                <ul class="text-xs text-zinc-600 dark:text-zinc-400 space-y-1 list-disc list-inside">
                    <li>"Increment Parent Only" updates parent but NOT the island</li>
                    <li>"Increment Island Only" updates island but NOT the parent</li>
                    <li>Each section re-renders independently!</li>
                </ul>
            </div>
        </div>

        <!-- Lazy Island Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Lazy Island (Viewport Loading)</h2>
            
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                Lazy islands don't render until they appear in the viewport. Scroll down to see it load!
            </p>

            <!-- Spacer to push lazy island below fold -->
            <div class="h-96 flex items-center justify-center bg-gradient-to-b from-purple-50 to-pink-50 dark:from-purple-900/10 dark:to-pink-900/10 rounded-lg border border-purple-200 dark:border-purple-800">
                <div class="text-center">
                    <svg class="w-16 h-16 text-purple-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                    <p class="text-sm font-medium text-purple-900 dark:text-purple-100">Scroll down to load the lazy island</p>
                </div>
            </div>

            @island(lazy: true)
                <div class="mt-6 border-2 border-dashed border-purple-500 rounded-lg p-6 bg-purple-50 dark:bg-purple-900/10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-3 h-3 bg-purple-500 rounded-full animate-pulse"></div>
                        <h3 class="text-sm font-semibold text-purple-900 dark:text-purple-100">Lazy Island Loaded!</h3>
                    </div>
                    <p class="text-sm text-purple-700 dark:text-purple-300">
                        This island was loaded when it entered the viewport. Check the network tab to see the request!
                    </p>
                    <div class="mt-4 p-3 bg-white dark:bg-purple-900/20 rounded">
                        <p class="text-xs text-purple-600 dark:text-purple-400 font-mono">
                            Loaded at: {{ now()->format('H:i:s') }}
                        </p>
                    </div>
                </div>
            @endisland
        </div>

        <!-- Defer Island Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Defer Island (Background Loading)</h2>
            
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                Defer islands load in the background after the initial page load, without waiting for viewport visibility.
            </p>

            @island(defer: true)
                <div class="border-2 border-dashed border-amber-500 rounded-lg p-6 bg-amber-50 dark:bg-amber-900/10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                        <h3 class="text-sm font-semibold text-amber-900 dark:text-amber-100">Defer Island</h3>
                    </div>
                    <p class="text-sm text-amber-700 dark:text-amber-300 mb-3">
                        This island loaded in the background after the page rendered. Perfect for non-critical content!
                    </p>
                    <div class="grid grid-cols-3 gap-3">
                        @for($i = 1; $i <= 6; $i++)
                            <div class="p-3 bg-white dark:bg-amber-900/20 rounded text-center">
                                <p class="text-xs text-amber-600 dark:text-amber-400 font-medium">Item {{ $i }}</p>
                            </div>
                        @endfor
                    </div>
                </div>
            @endisland
        </div>

        <!-- Always Island Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Always Island (Render with Parent)</h2>
            
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                Always islands re-render whenever their parent component updates, maintaining the island isolation benefits.
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 bg-cyan-50 dark:bg-cyan-900/10">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-3 h-3 bg-cyan-500 rounded-full"></div>
                        <h3 class="text-sm font-semibold text-cyan-900 dark:text-cyan-100">Parent Section</h3>
                    </div>
                    <p class="text-2xl font-bold text-cyan-600 dark:text-cyan-400 mb-3">{{ $parentCount }}</p>
                    <flux:button 
                        wire:click="incrementBoth" 
                        class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg text-sm font-medium transition-colors w-full"
                    >
                        Increment Both
                    </flux:button>
                </div>

                @island(always: true)
                    <div class="border-2 border-dashed border-pink-500 rounded-lg p-4 bg-pink-50 dark:bg-pink-900/10">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-3 h-3 bg-pink-500 rounded-full"></div>
                            <h3 class="text-sm font-semibold text-pink-900 dark:text-pink-100">Always Island</h3>
                        </div>
                        <p class="text-2xl font-bold text-pink-600 dark:text-pink-400 mb-3">{{ $islandCount }}</p>
                        <p class="text-xs text-pink-700 dark:text-pink-300">
                            This island updates when parent updates!
                        </p>
                    </div>
                @endisland
            </div>
        </div>

        <!-- Code Examples -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Code Examples</h2>
            
            <div class="space-y-6">
                <!-- Default Island -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Default Island</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@island
    &lt;div&gt;
        &lt;p&gt;{{ $islandCount }}&lt;/p&gt;
        &lt;button wire:click="incrementIsland"&gt;Increment&lt;/button&gt;
    &lt;/div&gt;
@endisland

&lt;!-- Only re-renders when island is explicitly targeted --&gt;</code></pre>
                </div>

                <!-- Lazy Island -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Lazy Island (Viewport Loading)</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@island(lazy: true)
    &lt;div&gt;
        &lt;!-- Loads when visible in viewport --&gt;
        &lt;p&gt;Lazy loaded content&lt;/p&gt;
    &lt;/div&gt;
@endisland</code></pre>
                </div>

                <!-- Defer Island -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Defer Island (Background Loading)</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@island(defer: true)
    &lt;div&gt;
        &lt;!-- Loads in background after page load --&gt;
        &lt;p&gt;Deferred content&lt;/p&gt;
    &lt;/div&gt;
@endisland</code></pre>
                </div>

                <!-- Always Island -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Always Island (Render with Parent)</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@island(always: true)
    &lt;div&gt;
        &lt;!-- Re-renders whenever parent updates --&gt;
        &lt;p&gt;{{ $islandCount }}&lt;/p&gt;
    &lt;/div&gt;
@endisland</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
