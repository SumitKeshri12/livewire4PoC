<?php

use App\Models\Card;
use App\Models\Column;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Computed;
use Livewire\Volt\Component;

new class extends Component {
    public Column $column;
    public bool $showNewCard = false;
    public string $newCardTitle = '';

    #[Computed]
    public function cards()
    {
        return $this->column->cards()->orderBy('position')->get();
    }
    
    #[Renderless]
    public function sortCard($item, $position)
    {
        $card = Card::find($item);
        if ($card) {
            $card->move($position, $this->column->id);
            unset($this->cards);
        }
    }
    
    public function addCard()
    {
        if (trim($this->newCardTitle) === '') {
            return;
        }
        
        Card::create([
            'column_id' => $this->column->id,
            'title' => $this->newCardTitle,
            'description' => '',
        ]);
        
        $this->newCardTitle = '';
        $this->showNewCard = false;
        $this->dispatch('card-added');
    }
    
    // Disabled to prevent column disappearing during drag operations
    // The refresh was causing Livewire to re-render while wire:sort was manipulating DOM
    // #[On('card-updated')]
    // #[On('card-added')]
    // #[On('card-moved')]
    // public function refresh()
    // {
    //     unset($this->cards);
    // }
}; ?>

<div class="flex-shrink-0 w-80">
    <div class="bg-slate-800/50 backdrop-blur-sm rounded-lg p-4 border border-slate-700">
        {{-- Column Header --}}
        <div class="flex items-center justify-between mb-4 column-header group">
            <div class="flex items-center gap-2">
                <div class="cursor-grab text-slate-500 hover:text-white column-drag-handle">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-white">{{ $column->name }}</h2>
            </div>
            <span class="bg-slate-700 text-slate-300 text-xs px-2 py-1 rounded-full">
                {{ $column->cards->count() }}
            </span>
        </div>

        {{-- Cards Container --}}
        <div 
            wire:sort="sortCard"
            wire:sort:group="cards"
            wire:sort:handle
            class="space-y-2 min-h-[200px]"
        >            
            @foreach($this->cards as $card)
                <div wire:sort:item="{{ $card->id }}" wire:key="card-{{ $card->id }}">
                    <livewire:kanban.card :key="'card-'.$card->id" :card="$card" />
                </div>
            @endforeach
        </div>

        {{-- New Card Button/Form --}}
        <div class="mt-4" wire:sort.ignore>
            @if(!$showNewCard)
                <button 
                    wire:click="$set('showNewCard', true)"
                    class="w-full text-left text-slate-400 hover:text-white hover:bg-slate-700/50 rounded px-3 py-2 transition-colors text-sm"
                >
                    + Add a card
                </button>
            @else
                <div class="space-y-2">
                    <input 
                        type="text"
                        wire:model="newCardTitle"
                        wire:keydown.enter="addCard"
                        wire:keydown.escape="$set('showNewCard', false)"
                        placeholder="Enter card title..."
                        class="w-full bg-slate-700 text-white rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                        autofocus
                    />
                    <div class="flex gap-2">
                        <button 
                            wire:click="addCard"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-sm transition-colors"
                        >
                            Add
                        </button>
                        <button 
                            wire:click="$set('showNewCard', false)"
                            class="text-slate-400 hover:text-white px-3 py-1 text-sm"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@script
<script>
    // Component-specific JavaScript for focus management
    $wire.on('show-new-card', () => {
        // Auto-focus input when shown
    });
</script>
@endscript
