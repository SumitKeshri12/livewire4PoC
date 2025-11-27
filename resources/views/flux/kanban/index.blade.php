@blaze
@php
    // Pass through wire:sort attribute to the sortable container
@endphp

<div {{ $attributes->except(['wire:sort', 'wire:sort:handle'])->merge(['class' => 'min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 py-8 px-4']) }}>
    <div class="max-w-7xl mx-auto">
        {{ $header ?? '' }}
        
        <div 
            {{ $attributes->only(['wire:sort', 'wire:sort:handle'])->class(['flex gap-4 overflow-x-auto pb-4']) }}
        >
            {{ $slot }}
        </div>
    </div>
</div>