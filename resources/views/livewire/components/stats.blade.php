<?php

use App\Models\Card;
use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        // Simulate slow loading
        sleep(1);
        
        return [
            'totalCards' => Card::count(),
            'completedCards' => Card::whereHas('column', fn($q) => $q->where('name', 'Done'))->count(),
        ];
    }
    
    public function placeholder()
    {
        return <<<'HTML'
        <div class="flex gap-4 animate-pulse">
            <div class="bg-slate-700/50 h-16 w-32 rounded-lg"></div>
            <div class="bg-slate-700/50 h-16 w-32 rounded-lg"></div>
        </div>
        HTML;
    }
}; ?>

<div class="flex gap-4">
    <div class="bg-slate-800/50 backdrop-blur-sm p-3 rounded-lg border border-slate-700">
        <div class="text-slate-400 text-xs uppercase font-bold tracking-wider">Total Tasks</div>
        <div class="text-2xl font-bold text-white">{{ $totalCards }}</div>
    </div>
    
    <div class="bg-purple-900/30 backdrop-blur-sm p-3 rounded-lg border border-purple-500/30">
        <div class="text-purple-300 text-xs uppercase font-bold tracking-wider">Completed</div>
        <div class="text-2xl font-bold text-white">{{ $completedCards }}</div>
    </div>
</div>
