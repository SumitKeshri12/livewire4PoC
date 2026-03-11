<?php

use Livewire\Volt\Component;

new class extends Component {
    // This component demonstrates Slots and Attribute Forwarding in Livewire 4.
}; ?>

<button {{ $attributes->merge(['class' => 'px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors font-medium']) }}>
    @if ((string) $slot === '')
        Default Button Text
    @else
        {{ $slot }}
    @endif

    @if (isset($icon))
        <div class="inline-block ml-2">
            {{ $icon }}
        </div>
    @endif
</button>
