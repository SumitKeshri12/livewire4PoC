<?php

use App\Models\Card;
use Livewire\Volt\Component;
use Livewire\Attributes\Reactive;

new class extends Component {
    public Card $card;
    public string $title = '';
    public string $description = '';
    public bool $showModal = false;
    
    public function mount()
    {
        $this->title = $this->card->title;
        $this->description = $this->card->description ?? '';
    }
    
    public function openModal()
    {
        $this->showModal = true;
        $this->title = $this->card->title;
        $this->description = $this->card->description ?? '';
    }
    
    public function closeModal()
    {
        $this->showModal = false;
    }
    
    public function save()
    {
        $this->card->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        
        $this->dispatch('card-updated');
        $this->showModal = false;
    }
}; ?>

<div>
    {{-- Card Preview (clickable) --}}
    <div 
        class="group relative bg-slate-700/50 hover:bg-slate-700 rounded-lg p-3 transition-colors border border-slate-600 hover:border-purple-500 flex gap-3"
    >
        {{-- Drag Handle --}}
        <div class="cursor-grab text-slate-500 hover:text-white card-drag-handle self-start pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
            </svg>
        </div>

        {{-- Content --}}
        <div class="flex-1 cursor-pointer" wire:click="openModal">
            <h3 class="text-white font-medium text-sm mb-1">{{ $card->title }}</h3>
            @if($card->description)
                <div class="text-slate-400 text-xs line-clamp-2 prose prose-invert prose-xs">
                    {!! Str::markdown($card->description) !!}
                </div>
            @endif
        </div>
    </div>

    {{-- Edit Modal --}}
    @if($showModal)
        <div 
            class="fixed inset-0 z-50 overflow-y-auto"
            x-data
            x-on:keydown.escape.window="$wire.closeModal()"
        >
            {{-- Backdrop --}}
            <div 
                class="fixed inset-0 bg-black/50 backdrop-blur-sm"
                wire:click="closeModal"
            ></div>

            {{-- Modal Content --}}
            <div class="flex min-h-full items-center justify-center p-4">
                <div 
                    class="relative bg-slate-800 rounded-lg shadow-xl max-w-md w-full p-6 space-y-6"
                    x-on:click.stop
                >
                    {{-- Header --}}
                    <div>
                        <h2 class="text-2xl font-bold text-white">Edit Card</h2>
                        <p class="text-slate-400 text-sm mt-1">Update the card details below</p>
                    </div>

                    {{-- Form --}}
                    <form wire:submit="save" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Title</label>
                            <input 
                                type="text"
                                wire:model="title"
                                class="w-full bg-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                placeholder="Enter card title..."
                                required
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-white mb-2">Description</label>
                            <textarea 
                                wire:model="description"
                                rows="6"
                                class="w-full bg-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                placeholder="Enter card description..."
                            ></textarea>
                        </div>

                        {{-- Actions --}}
                        <div class="flex justify-end gap-2 pt-4">
                            <button 
                                type="button"
                                wire:click="closeModal"
                                class="px-4 py-2 text-slate-400 hover:text-white transition-colors"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors"
                            >
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
