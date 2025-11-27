<?php

use App\Models\Column;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('Dashboard')] class extends Component {
    public function with(): array
    {
        return [
            'columns' => Column::ordered()->with('cards')->get(),
        ];
    }

    #[Renderless]
    public function sortColumn($item, $position)
    {
        $column = Column::find($item);
        $column?->move($position);
    }
}; ?>


<flux:kanban>
    <x-slot:header>
        <flux:kanban.header>
            <livewire:components.stats lazy />
        </flux:kanban.header>
    </x-slot:header>
    
    <div wire:sort="sortColumn" wire:sort:handle class="flex gap-4">
        @foreach($columns as $column)
            <div wire:sort:item="{{ $column->id }}" wire:key="column-{{ $column->id }}">
                <livewire:kanban.column :column="$column" :key="'column-'.$column->id" />
            </div>
        @endforeach
    </div>
</flux:kanban>
