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
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">🔥 What is Blaze?</h1>
            <p class="text-lg text-zinc-600 dark:text-zinc-400">
                Blaze is a compile-time optimization engine that "folds" static Blade components to eliminate unnecessary rendering overhead.
            </p>
        </div>

        <!-- The Problem Blaze Solves -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-3">The Problem Blaze Solves</h2>
            <p class="text-zinc-600 dark:text-zinc-400 mb-2">
                Normally, when you render a Blade component in a loop, Laravel has to:
            </p>
            <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-400 mb-4 ml-4">
                <li>Parse the component template</li>
                <li>Compile it to PHP</li>
                <li>Execute the PHP code</li>
                <li>Return the HTML</li>
            </ul>
            <p class="text-red-600 dark:text-red-400 font-medium mb-4">
                This happens EVERY TIME for EVERY iteration!
            </p>
            <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@verbatim{{-- Without Blaze: Renders 100 times! --}}
@for($i = 1; $i <= 100; $i++)
    <x-button>{{ $i }}</x-button>
@endfor@endverbatim</code></pre>
        </div>

        <!-- How Blaze Works -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-3">How Blaze Works</h2>
            <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                Blaze detects when a component's structure is static (doesn't change based on props) and only the content is dynamic. It then "folds" the component at compile-time.
            </p>
            <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs mb-4"><code>@verbatim{{-- Component: button.blade.php --}}
@blaze  {{-- This directive tells Blaze to optimize --}}

<div class="px-3 py-1.5 bg-indigo-600 text-white rounded">
    {{ $slot }}  {{-- Only this part is dynamic --}}
</div>@endverbatim</code></pre>
            <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                Result: The component structure is compiled ONCE, and only the slot content changes!
            </p>
            <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@verbatim{{-- With Blaze: 0 component renders! --}}
@for($i = 1; $i <= 100; $i++)
    <x-button>{{ $i }}</x-button>
@endfor

{{-- Blaze compiles this to something like: --}}
@for($i = 1; $i <= 100; $i++)
    <div class="px-3 py-1.5 bg-indigo-600 text-white rounded">
        {{ $i }}
    </div>
@endfor@endverbatim</code></pre>
        </div>

        <!-- Performance Comparison Table -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">📊 Performance Comparison</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-200 dark:border-zinc-700">
                            <th class="text-left py-3 px-4 text-zinc-700 dark:text-zinc-300">Scenario</th>
                            <th class="text-center py-3 px-4 text-zinc-700 dark:text-zinc-300">Without Blaze</th>
                            <th class="text-center py-3 px-4 text-zinc-700 dark:text-zinc-300">With Blaze</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-zinc-100 dark:border-zinc-800">
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">100 buttons in a loop</td>
                            <td class="text-center py-3 px-4 text-red-600 dark:text-red-400">100 component renders</td>
                            <td class="text-center py-3 px-4 text-emerald-600 dark:text-emerald-400">0 component renders</td>
                        </tr>
                        <tr class="border-b border-zinc-100 dark:border-zinc-800">
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Page load time</td>
                            <td class="text-center py-3 px-4 text-red-600 dark:text-red-400">Slower</td>
                            <td class="text-center py-3 px-4 text-emerald-600 dark:text-emerald-400">Much faster</td>
                        </tr>
                        <tr>
                            <td class="py-3 px-4 text-zinc-600 dark:text-zinc-400">Memory usage</td>
                            <td class="text-center py-3 px-4 text-red-600 dark:text-red-400">Higher</td>
                            <td class="text-center py-3 px-4 text-emerald-600 dark:text-emerald-400">Lower</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Live Demo -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-8">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">🎮 Live Demo</h2>
            
            <div class="mb-4">
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-3">
                    Rendering {{ $itemCount }} buttons below. Watch the performance difference!
                </p>
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-zinc-500 dark:text-zinc-400">With Blaze:</span>
                        <span class="px-3 py-1.5 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-sm font-bold rounded">
                            0 renders ⚡
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-zinc-500 dark:text-zinc-400">Without Blaze:</span>
                        <span class="px-3 py-1.5 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-sm font-bold rounded">
                            {{ $itemCount }} renders 🐌
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-2">
                @for($i = 1; $i <= $itemCount; $i++)
                    @if($useBlaze)
                        <x-blaze-button>{{ $i }}</x-blaze-button>
                    @else
                        <x-blaze-dynamic-button>{{ $i }}</x-blaze-dynamic-button>
                    @endif
                @endfor
            </div>
        </div>

        <!-- When to Use Blaze -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Blaze Eligible -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border-2 border-emerald-500 p-6">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-emerald-900 dark:text-emerald-100">✅ When Can You Use Blaze?</h3>
                </div>
                
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    Blaze works when:
                </p>

                <div class="space-y-2">
                    <div class="flex items-start gap-2 text-sm">
                        <span class="text-emerald-600">✅</span>
                        <span class="text-zinc-600 dark:text-zinc-400"><strong>Component structure is static</strong> (same HTML every time)</span>
                    </div>
                    <div class="flex items-start gap-2 text-sm">
                        <span class="text-emerald-600">✅</span>
                        <span class="text-zinc-600 dark:text-zinc-400"><strong>Only slot content is dynamic</strong></span>
                    </div>
                    <div class="flex items-start gap-2 text-sm">
                        <span class="text-emerald-600">✅</span>
                        <span class="text-zinc-600 dark:text-zinc-400"><strong>No conditional rendering</strong> based on props</span>
                    </div>
                    <div class="flex items-start gap-2 text-sm">
                        <span class="text-emerald-600">✅</span>
                        <span class="text-zinc-600 dark:text-zinc-400"><strong>No loops inside the component</strong> that depend on props</span>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 mb-2">Example - Blaze-Eligible:</p>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@verbatim@blaze
<button class="btn btn-primary">
    {{ $slot }}
</button>@endverbatim</code></pre>
                </div>
            </div>

            <!-- NOT Blaze Eligible -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border-2 border-red-500 p-6">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <h3 class="text-lg font-semibold text-red-900 dark:text-red-100">❌ When Blaze Won't Work</h3>
                </div>
                
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4">
                    Blaze CANNOT optimize when:
                </p>

                <div class="space-y-2">
                    <div class="flex items-start gap-2 text-sm">
                        <span class="text-red-600">❌</span>
                        <span class="text-zinc-600 dark:text-zinc-400"><strong>Props change the DOM structure</strong></span>
                    </div>
                    <div class="flex items-start gap-2 text-sm">
                        <span class="text-red-600">❌</span>
                        <span class="text-zinc-600 dark:text-zinc-400"><strong>Conditional rendering</strong> based on props</span>
                    </div>
                    <div class="flex items-start gap-2 text-sm">
                        <span class="text-red-600">❌</span>
                        <span class="text-zinc-600 dark:text-zinc-400"><strong>Dynamic classes/attributes</strong> from props</span>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 mb-2">Example - NOT Blaze-Eligible:</p>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@verbatim@props(['size' => 'md'])

{{-- Size prop changes the structure --}}
<button class="btn btn-{{ $size }}">
    {{ $slot }}
</button>@endverbatim</code></pre>
                </div>
            </div>
        </div>

        <!-- Real World Example -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-3">🎯 Real-World Example</h2>
            <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                Let's say you're rendering a list of 1000 products:
            </p>
            <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs mb-4"><code>@verbatim{{-- products.blade.php --}}
@foreach($products as $product)
    <x-product-card>
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->price }}</p>
    </x-product-card>
@endforeach@endverbatim</code></pre>
            <p class="text-zinc-600 dark:text-zinc-400">
                Without Blaze: 1000 component renders = slow<br>
                With Blaze: 0 component renders = blazing fast! 🔥
            </p>
        </div>

        <!-- How to Check -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-3">🔍 How to Check if Blaze is Working</h2>
            <p class="text-zinc-600 dark:text-zinc-400 mb-2">
                Visit /blaze in your app and look at the demo. You'll see:
            </p>
            <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-400 mb-4 ml-4">
                <li>With Blaze: "0 renders (folded at compile-time)"</li>
                <li>Without Blaze: "100 renders"</li>
            </ul>
            <p class="text-zinc-600 dark:text-zinc-400">
                You can also check Laravel Debugbar to see the render count.
            </p>
        </div>

        <!-- Key Takeaway -->
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-lg border border-indigo-200 dark:border-indigo-800 p-6">
            <h2 class="text-xl font-semibold text-indigo-900 dark:text-indigo-100 mb-3">💡 Key Takeaway</h2>
            
            <div class="space-y-3">
                <p class="text-sm text-indigo-800 dark:text-indigo-200">
                    <strong class="text-lg">Blaze = "Compile once, use many times"</strong>
                </p>
                
                <p class="text-sm text-indigo-700 dark:text-indigo-300">
                    Instead of rendering the same component structure 100 times, Blaze compiles it <strong>once at build time</strong> and just swaps in the dynamic content. 
                    It's like using a template/stamp instead of drawing the same thing over and over!
                </p>
            </div>
        </div>
    </div>
</div>
