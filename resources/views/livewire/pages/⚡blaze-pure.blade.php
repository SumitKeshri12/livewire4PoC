<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('Blaze Pure Test')] class extends Component {
    public array $ids = [1, 2, 3, 4, 5];
}; ?>

<div class="p-8">
    <table class="w-full">
        <tbody>
            @foreach($ids as $id)
                <x-blaze-table-row>
                    ID: {{ $id }}
                </x-blaze-table-row>
            @endforeach
        </tbody>
    </table>
</div>
