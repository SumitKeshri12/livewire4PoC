<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('New Livewire 4 Features')] class extends Component {
    public bool $showElement = true;
    public string $buttonColor = 'bg-blue-600';
    public int $counter = 0;
    public function increment() { $this->counter++; }
    public string $inputA = '';
    public string $inputB = '';
    public function updatedInputA() { sleep(1); }
    public function updatedInputB() { sleep(1); }
}; ?>

<div class="space-y-12">
    <div>
        <flux:heading size="xl" class="text-white mb-2">New Livewire 4 Features Explained</flux:heading>
        <p class="text-slate-400 text-sm">A detailed breakdown of major improvements in Livewire 4, with code comparisons and interactive demonstrations.</p>
    </div>

    <div class="space-y-12">
        {{-- =============================== --}}
        {{-- SECTION 1: wire:show --}}
        {{-- =============================== --}}
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 space-y-6">
            <div class="flex justify-between items-center border-b border-slate-700 pb-4">
                <flux:heading size="lg" class="text-white">1. Instant Toggling with wire:show</flux:heading>
                <flux:badge color="purple">New in LW4</flux:badge>
            </div>

            <div class="text-sm text-slate-300 space-y-3 leading-relaxed">
                <p><strong>How it works:</strong> Instead of completely removing an element from the DOM (which requires a server round-trip), <code>wire:show</code> toggles CSS <code>display: none</code> on the client side instantly. The server property value stays in sync, but the visibility change is immediate.</p>
                <p><strong>Key benefit:</strong> Zero network latency on show/hide operations. No loading spinner needed.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                <div class="bg-slate-900 rounded p-4 text-slate-400">
                    <div class="text-slate-500 mb-2 border-b border-slate-700 pb-1">// Livewire 3 — server round-trip required</div>
                    <pre class="whitespace-pre-wrap">@verbatim
{{-- Causes full component re-render --}}
@if ($showElement)
    <div>I appear and disappear!</div>
@endif
@endverbatim</pre>
                </div>
                <div class="bg-slate-900 rounded p-4 text-green-300 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                    <div class="text-green-500 mb-2 border-b border-green-500/20 pb-1">// Livewire 4 — instant client-side toggle</div>
                    <pre class="whitespace-pre-wrap">@verbatim
{{-- Element stays in DOM; CSS hides it --}}
<div wire:show="showElement">
    I appear and disappear!
</div>
@endverbatim</pre>
                </div>
            </div>

            <div class="p-6 bg-slate-700/30 rounded-lg flex flex-col items-center gap-4 border border-slate-600/50">
                <flux:button wire:click="$toggle('showElement')" variant="primary" color="purple">
                    Toggle Element
                </flux:button>
                <div wire:show="showElement" class="p-4 bg-green-600/20 border border-green-500/50 rounded-lg text-green-400">
                    Notice how instant this is — no loading spinner!
                </div>
            </div>
        </div>

        {{-- =============================== --}}
        {{-- SECTION 2: wire:bind --}}
        {{-- =============================== --}}
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 space-y-6">
            <div class="flex justify-between items-center border-b border-slate-700 pb-4">
                <flux:heading size="lg" class="text-white">2. Granular Attribute Binding with wire:bind</flux:heading>
                <flux:badge color="purple">New in LW4</flux:badge>
            </div>

            <div class="text-sm text-slate-300 space-y-3 leading-relaxed">
                <p><strong>How it works:</strong> <code>wire:bind:attribute="property"</code> binds any HTML attribute to a server-side property. When the property changes, Livewire 4 only patches that single attribute in the DOM — it does NOT re-render the whole element's HTML.</p>
                <p><strong>Key benefit:</strong> Reduces data sent over the wire. Preserves focus, animation states, and other client-side element state.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                <div class="bg-slate-900 rounded p-4 text-slate-400">
                    <div class="text-slate-500 mb-2 border-b border-slate-700 pb-1">// Livewire 3 — entire element re-rendered</div>
                    <pre class="whitespace-pre-wrap">@verbatim
{{-- Replaces the whole div on every change --}}
<div class="{{ $buttonColor }} px-4 py-2">
    My Button
</div>
@endverbatim</pre>
                </div>
                <div class="bg-slate-900 rounded p-4 text-green-300 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                    <div class="text-green-500 mb-2 border-b border-green-500/20 pb-1">// Livewire 4 — only the class attribute updated</div>
                    <pre class="whitespace-pre-wrap">@verbatim
{{-- Only class="" attribute patched in DOM --}}
<div wire:bind:class="buttonColor"
     class="px-4 py-2">
    My Button
</div>
@endverbatim</pre>
                </div>
            </div>

            <div class="p-6 bg-slate-700/30 rounded-lg space-y-6 border border-slate-600/50">
                <div class="flex gap-4 justify-center">
                    <button wire:click="$set('buttonColor', 'bg-blue-600')" class="w-10 h-10 rounded-full bg-blue-600 ring-2 ring-offset-2 ring-offset-slate-800 ring-blue-500 hover:scale-110 transition-transform" title="Blue"></button>
                    <button wire:click="$set('buttonColor', 'bg-red-600')" class="w-10 h-10 rounded-full bg-red-600 ring-2 ring-offset-2 ring-offset-slate-800 ring-red-500 hover:scale-110 transition-transform" title="Red"></button>
                    <button wire:click="$set('buttonColor', 'bg-orange-600')" class="w-10 h-10 rounded-full bg-orange-600 ring-2 ring-offset-2 ring-offset-slate-800 ring-orange-500 hover:scale-110 transition-transform" title="Orange"></button>
                </div>
                <div class="flex justify-center">
                    <div wire:bind:class="buttonColor" class="px-8 py-4 text-white rounded-lg font-bold transition-all duration-300 shadow-xl">
                        Dynamic Class Binding Demo
                    </div>
                </div>
            </div>
        </div>

        {{-- =============================== --}}
        {{-- SECTION 3: wire:ref --}}
        {{-- =============================== --}}
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 space-y-6">
            <div class="flex justify-between items-center border-b border-slate-700 pb-4">
                <flux:heading size="lg" class="text-white">3. Elements Refs with wire:ref</flux:heading>
                <flux:badge color="purple">New in LW4</flux:badge>
            </div>

            <div class="text-sm text-slate-300 space-y-3 leading-relaxed">
                <p><strong>How it works:</strong> <code>wire:ref="name"</code> marks a DOM element with a stable, named reference. You can retrieve it in JavaScript via <code>$wire.el.querySelector('[wire\:ref=name]')</code> or simply pass it to third-party libraries (charts, editors, etc.) without needing to generate unique IDs.</p>
                <p><strong>Key benefit:</strong> Cleaner JavaScript integration without fragile ID generation or Alpine's scoping workarounds.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                <div class="bg-slate-900 rounded p-4 text-slate-400">
                    <div class="text-slate-500 mb-2 border-b border-slate-700 pb-1">// Livewire 3 — manual ID management</div>
                    <pre class="whitespace-pre-wrap">@verbatim
<div id="chart-{{ $row->id }}"></div>

{{-- Must compute the same ID in JS --}}
<script>
  const el = document.getElementById(
    'chart-{{ $row->id }}'
  );
</script>
@endverbatim</pre>
                </div>
                <div class="bg-slate-900 rounded p-4 text-green-300 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                    <div class="text-green-500 mb-2 border-b border-green-500/20 pb-1">// Livewire 4 — named refs</div>
                    <pre class="whitespace-pre-wrap">@verbatim
<div wire:ref="chartContainer"></div>

{{-- Stable selector, no ID needed --}}
<script>
  const el = document.querySelector(
    '[wire\:ref=chartContainer]'
  );
</script>
@endverbatim</pre>
                </div>
            </div>

            <div class="p-6 bg-slate-700/30 rounded-lg flex flex-col items-center gap-4 border border-slate-600/50">
                <div wire:ref="myTarget" class="p-8 border-2 border-dashed border-slate-500 rounded-lg text-slate-400 bg-slate-800/80 font-mono w-full text-center">
                    Awaiting JavaScript update...
                </div>
                <flux:button
                    x-data
                    x-on:click="([...$el.closest('div').querySelectorAll('*')].find(el => el.getAttribute('wire:ref') === 'myTarget')).innerText = 'Updated directly by client-side JS!'"
                    variant="ghost"
                >
                    Update via JS (No Server)
                </flux:button>
            </div>
        </div>

        {{-- =============================== --}}
        {{-- SECTION 4: Slots & Attributes --}}
        {{-- =============================== --}}
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 space-y-6">
            <div class="flex justify-between items-center border-b border-slate-700 pb-4">
                <flux:heading size="lg" class="text-white">4. Bulletproof Slots & Attribute Forwarding</flux:heading>
                <flux:badge color="indigo">Improved</flux:badge>
            </div>

            <div class="text-sm text-slate-300 space-y-3 leading-relaxed">
                <p><strong>How it works:</strong> Livewire 4 fully aligns its component rendering pipeline with Laravel's Blade component engine. Named slots (<code>x-slot:name</code>), attribute bags (<code>$attributes->merge()</code>), and forwarded classes all work exactly as they do in regular Blade components.</p>
                <p><strong>Key benefit:</strong> You can build a proper design system of Livewire components that compose cleanly — no more dropped attributes or slot content leaking.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                <div class="bg-slate-900 rounded p-4 text-slate-400">
                    <div class="text-slate-500 mb-2 border-b border-slate-700 pb-1">// Livewire 3 — attributes often dropped</div>
                    <pre class="whitespace-pre-wrap">@verbatim
<livewire:button class="bg-red-600">
    <x-slot name="icon">★</x-slot>
    Click Me
</livewire:button>
{{-- class="bg-red-600" often lost on re-render --}}
@endverbatim</pre>
                </div>
                <div class="bg-slate-900 rounded p-4 text-green-300 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                    <div class="text-green-500 mb-2 border-b border-green-500/20 pb-1">// Livewire 4 — perfect parity</div>
                    <pre class="whitespace-pre-wrap">@verbatim
<livewire:button class="bg-red-600">
    <x-slot:icon>★</x-slot:icon>
    Click Me
</livewire:button>
{{-- class forwarded + merged properly --}}
@endverbatim</pre>
                </div>
            </div>

            <div class="p-6 bg-slate-700/30 rounded-lg flex justify-center border border-slate-600/50">
                <livewire:components.button title="Title forwarded via $attributes!" class="shadow-xl ring-2 ring-purple-500/50 hover:scale-105 transition-transform">
                    Hover me (see forwarded title attr)
                </livewire:components.button>
            </div>
        </div>

        {{-- =============================== --}}
        {{-- SECTION 5: Non-blocking Poll --}}
        {{-- =============================== --}}
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 space-y-6">
            <div class="flex justify-between items-center border-b border-slate-700 pb-4">
                <flux:heading size="lg" class="text-white">5. Non-Blocking Background Polling</flux:heading>
                <flux:badge color="purple">New in LW4</flux:badge>
            </div>

            <div class="text-sm text-slate-300 space-y-3 leading-relaxed">
                <p><strong>How it works:</strong> Livewire 4 redesigns its request scheduler to de-prioritize poll requests. User-triggered events (clicks, model updates) always take priority. If a poll fires while a user action is pending, it waits silently rather than blocking.</p>
                <p><strong>Key benefit:</strong> Polling data (live counters, dashboards) no longer causes input lag on forms in the same component.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                <div class="bg-slate-900 rounded p-4 text-slate-400">
                    <div class="text-slate-500 mb-2 border-b border-slate-700 pb-1">// Livewire 3 — polling blocks interactions</div>
                    <pre class="whitespace-pre-wrap">@verbatim
// Request queue: [poll] → [click] → [poll]
// User must wait for poll to finish
// before their click is processed
<div wire:poll.2000ms="refresh"></div>
@endverbatim</pre>
                </div>
                <div class="bg-slate-900 rounded p-4 text-green-300 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                    <div class="text-green-500 mb-2 border-b border-green-500/20 pb-1">// Livewire 4 — polling never blocks</div>
                    <pre class="whitespace-pre-wrap">@verbatim
// Scheduler: click always wins priority
// Poll waits for user actions to clear
// No input lag at all
<div wire:poll.2000ms="increment"></div>
@endverbatim</pre>
                </div>
            </div>

            <div class="p-6 bg-slate-700/30 rounded-lg flex flex-col items-center gap-6 border border-slate-600/50">
                <div wire:poll="increment" class="text-4xl font-mono text-fuchsia-400 font-bold bg-slate-900 px-6 py-2 rounded-lg border border-fuchsia-500/30">
                    Counter: {{ $counter }}
                </div>
                <div class="w-full">
                    <label class="text-xs text-slate-400 mb-1 block">Type quickly here. The counter should NOT lag your input:</label>
                    <flux:input placeholder="Type here while the counter is polling..." class="w-full" />
                </div>
            </div>
        </div>

        {{-- =============================== --}}
        {{-- SECTION 6: Parallel Updates --}}
        {{-- =============================== --}}
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 space-y-6">
            <div class="flex justify-between items-center border-b border-slate-700 pb-4">
                <flux:heading size="lg" class="text-white">6. True Parallel Requests</flux:heading>
                <flux:badge color="purple">New in LW4</flux:badge>
            </div>

            <div class="text-sm text-slate-300 space-y-3 leading-relaxed">
                <p><strong>How it works:</strong> Livewire 4 uses request multiplexing. Multiple simultaneous updates (e.g., two <code>wire:model.live</code> inputs) fire as concurrent HTTP requests, not sequential ones. Both server callbacks run in parallel and responses are merged when done.</p>
                <p><strong>Key benefit:</strong> Users on slow connections or with server-side async work get responses much faster when multiple properties update at once.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                <div class="bg-slate-900 rounded p-4 text-slate-400">
                    <div class="text-slate-500 mb-2 border-b border-slate-700 pb-1">// Livewire 3 — requests are sequential</div>
                    <pre class="whitespace-pre-wrap">// Input A triggers: Req1 starts
// Input B triggers: Req2 QUEUED
// Req1 finishes (~1s)
// Req2 starts, finishes (~1s)
// Total UI update time: ~2 seconds</pre>
                </div>
                <div class="bg-slate-900 rounded p-4 text-green-300 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                    <div class="text-green-500 mb-2 border-b border-green-500/20 pb-1">// Livewire 4 — parallel multiplexing</div>
                    <pre class="whitespace-pre-wrap">// Input A triggers: Req1 starts
// Input B triggers: Req2 starts (now!)
// Both finish concurrently (~1s)
// Total UI update time: ~1 second</pre>
                </div>
            </div>

            <div class="p-6 bg-slate-700/30 rounded-lg space-y-4 border border-slate-600/50">
                <p class="text-xs text-amber-400">Both inputs call a 1-second sleep on the server. Type in one and quickly in the other — both should resolve at roughly the same time.</p>
                <div class="flex gap-4">
                    <flux:input wire:model.live="inputA" placeholder="Input A (1s server delay)" />
                    <flux:input wire:model.live="inputB" placeholder="Input B (1s server delay)" />
                </div>
                <div class="flex gap-8 justify-center mt-4 text-sm font-mono text-slate-400">
                    <span class="bg-slate-900 px-3 py-1 rounded">Server A echoes: <strong class="text-white">{{ $inputA }}</strong></span>
                    <span class="bg-slate-900 px-3 py-1 rounded">Server B echoes: <strong class="text-white">{{ $inputB }}</strong></span>
                </div>
            </div>
        </div>

        {{-- =============================== --}}
        {{-- SECTION 7: Lazy + Placeholder --}}
        {{-- =============================== --}}
        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl p-6 border border-slate-700 space-y-6">
            <div class="flex justify-between items-center border-b border-slate-700 pb-4">
                <flux:heading size="lg" class="text-white">7. Declarative Lazy Loading & Skeletons</flux:heading>
                <flux:badge color="purple">New in LW4</flux:badge>
            </div>

            <div class="text-sm text-slate-300 space-y-3 leading-relaxed">
                <p><strong>How it works:</strong> Add <code>lazy</code> to any <code>&lt;livewire:...&gt;</code> tag and it defers the component's initial render until after the page loads. While waiting, Livewire renders the component's <code>placeholder()</code> method output. This is the built-in skeleton loading pattern.</p>
                <p><strong>Key benefit:</strong> Faster initial page load for expensive components (e.g., dashboard widgets, analytics charts). Zero boilerplate — no more manual <code>wire:init</code> flag-flipping.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-mono">
                <div class="bg-slate-900 rounded p-4 text-slate-400">
                    <div class="text-slate-500 mb-2 border-b border-slate-700 pb-1">// Livewire 3 — manual skeleton boilerplate</div>
                    <pre class="whitespace-pre-wrap">@verbatim
// Component PHP:
public bool $ready = false;
public function load(): void {
    sleep(1); // expensive work
    $this->ready = true;
}

// Blade template:
<div wire:init="load">
    @if ($ready)
        <x-chart />
    @else
        <x-skeleton />
    @endif
</div>
@endverbatim</pre>
                </div>
                <div class="bg-slate-900 rounded p-4 text-green-300 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                    <div class="text-green-500 mb-2 border-b border-green-500/20 pb-1">// Livewire 4 — zero boilerplate</div>
                    <pre class="whitespace-pre-wrap">@verbatim
// Usage in parent blade:
<livewire:chart lazy />

// Component PHP:
public function with(): array {
    sleep(1); // runs after page loads
    return ['data' => $this->load()];
}
public function placeholder() {
    return <<<HTML
        <x-skeleton />
    HTML;
}
@endverbatim</pre>
                </div>
            </div>

            <div class="p-6 bg-slate-700/30 rounded-lg min-h-[140px] flex items-center justify-center border border-slate-600/50">
                <div class="bg-slate-900/80 p-6 rounded-lg border border-slate-700 w-full max-w-md">
                    <h3 class="text-slate-400 text-xs uppercase font-bold tracking-wider mb-4 border-b border-slate-800 pb-2">Stats Widget (1s lazy load)</h3>
                    <livewire:components.stats lazy />
                </div>
            </div>
        </div>
    </div>
</div>
