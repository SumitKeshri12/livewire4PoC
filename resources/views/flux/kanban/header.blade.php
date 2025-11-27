@props([
    'title' => 'Kanban Board',
    'subtitle' => 'Livewire 4 + Flux Demo - Drag and drop to organize your tasks',
])

<div class="mb-8 flex justify-between items-end">
    <div>
        <h1 class="text-4xl font-bold text-white mb-2">{{ $title }}</h1>
        <p class="text-slate-300">{{ $subtitle }}</p>
    </div>
    
    {{ $slot }}
</div>
