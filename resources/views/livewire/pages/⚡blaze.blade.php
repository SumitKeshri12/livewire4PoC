<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('Blaze Optimization - LiveWire 4')] class extends Component {
    public bool $useBlaze = true;
    public int $itemCount = 100;

    public function toggleBlaze()
    {
        $this->useBlaze = !$this->useBlaze;
    }

    public function clearCache()
    {
        \Artisan::call('view:clear');
    }
}; ?>

<div class="p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Blaze Optimization</h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Code folding and compile-time optimization for blazing-fast Blade component rendering.
            </p>
        </div>

        <!-- Controls -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-1">Blaze Status</h2>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">

        <!-- Performance Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Performance Comparison</h2>
            
            <div class="mb-4">
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-2">
                    Rendering {{ $itemCount }} buttons. Check Laravel Debugbar for render count.
                </p>
                <div class="flex items-center gap-2">
                    <span class="text-xs text-zinc-500 dark:text-zinc-400">With Blaze:</span>
                    <span class="px-2 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-xs font-bold rounded">
                        0 renders (folded at compile-time)
                    </span>
                </div>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-xs text-zinc-500 dark:text-zinc-400">Without Blaze:</span>
                    <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-bold rounded">
                        {{ $itemCount }} renders
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-2">
                @for($i = 1; $i <= $itemCount; $i++)
                    @if($useBlaze)
                        <x-blaze-button>{{ $i }}</x-blaze-button>
                    @else
                        <x-blaze-dynamic-button>{{ $i }}</x-blaze-dynamic-button>
                    @endif
                @endfor
            </div>
        </div>

        <!-- How It Works -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Static Component (Blaze Eligible) -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Static Component</h3>
                </div>
                
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    This component is eligible for Blaze code folding because its structure doesn't change based on props.
                </p>

                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-zinc-600 dark:text-zinc-400">Static HTML structure</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-zinc-600 dark:text-zinc-400">Dynamic slot content</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-zinc-600 dark:text-zinc-400">Rendered at compile-time</span>
                    </div>
                </div>
            </div>

            <!-- Dynamic Component (Not Eligible) -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Dynamic Component</h3>
                </div>
                
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    This component is NOT eligible because props affect the DOM structure.
                </p>

                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="text-zinc-600 dark:text-zinc-400">Conditional rendering</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="text-zinc-600 dark:text-zinc-400">Props change structure</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="text-zinc-600 dark:text-zinc-400">Rendered at runtime</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Code Examples -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Code Examples</h2>
            
            <div class="space-y-6">
                <!-- Static Component -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">✅ Blaze-Eligible Component</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@blaze

&lt;div class="px-3 py-1.5 bg-indigo-600 text-white rounded text-xs font-medium"&gt;
    {{ $slot }}
&lt;/div&gt;

&lt;!-- Structure is static, only slot content is dynamic --&gt;
&lt;!-- Blaze will fold this at compile-time! --&gt;</code></pre>
                </div>

                <!-- Dynamic Component -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">❌ Not Blaze-Eligible Component</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@props(['size' => 'md'])

&lt;div class="px-3 py-1.5 bg-zinc-600 text-white rounded text-{{ $size }} font-medium"&gt;
    {{ $slot }}
&lt;/div&gt;

&lt;!-- Size prop changes the DOM structure --&gt;
&lt;!-- Blaze cannot fold this --&gt;</code></pre>
                </div>

                <!-- Usage -->
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Usage in Loop</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@for($i = 1; $i <= 100; $i++)
    &lt;x-blaze-button&gt;{{ $i }}&lt;/x-blaze-button&gt;
@endfor

&lt;!-- With Blaze: 0 renders (folded at compile-time) --&gt;
&lt;!-- Without Blaze: 100 renders --&gt;</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
