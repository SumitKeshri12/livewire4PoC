<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;

new #[Layout('layouts.app'), Title('Infinite Scroll - LiveWire 4')] class extends Component {
    public int $page = 1;
    public int $perPage = 10;
    public bool $hasMore = true;

    public function with(): array
    {
        $users = User::skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();

        $this->hasMore = User::count() > ($this->page * $this->perPage);

        return [
            'users' => $users,
        ];
    }

    public function loadMore()
    {
        $this->page++;
    }
}; ?>

<div class="p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Infinite Scroll</h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Lazy loading with viewport detection and append mode using Islands.
            </p>
        </div>

        <!-- Info Card -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg border border-blue-200 dark:border-blue-800 p-6 mb-8">
            <h2 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">How It Works</h2>
            <p class="text-sm text-blue-800 dark:text-blue-200 mb-3">
                This demo uses a <strong>lazy island</strong> at the bottom of the list. When it enters the viewport, 
                it automatically loads more items and appends them to the list without re-rendering existing items.
            </p>
            <div class="flex items-center gap-2 text-xs text-blue-700 dark:text-blue-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Scroll down to see it in action!</span>
            </div>
        </div>

        <!-- User List -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="p-4 border-b border-zinc-200 dark:border-zinc-700">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Users</h2>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">Page {{ $page }} • {{ $perPage }} per page</p>
            </div>

            @island(name: 'users')
                <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @foreach($users as $user)
                        <div class="p-4 hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-zinc-900 dark:text-white">{{ $user->name }}</h3>
                                    <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ $user->email }}</p>
                                </div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">
                                    ID: {{ $user->id }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endisland

            <!-- Lazy Loading Trigger -->
            @if($hasMore)
                @island(lazy: true, name: 'users')
                    <div wire:init="loadMore" class="p-8 text-center bg-zinc-50 dark:bg-zinc-900">
                        <div class="inline-flex items-center gap-3 text-sm text-zinc-600 dark:text-zinc-400">
                            <svg class="w-5 h-5 animate-spin text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Loading more users...</span>
                        </div>
                    </div>
                @endisland
            @else
                <div class="p-8 text-center bg-zinc-50 dark:bg-zinc-900 border-t border-zinc-200 dark:border-zinc-700">
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        🎉 You've reached the end! No more users to load.
                    </p>
                </div>
            @endif
        </div>

        <!-- Code Example -->
        <div class="mt-8 bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Code Example</h2>
            
            <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>@island(name: 'users')
    @foreach($users as $user)
        <div>{{ $user->name }}</div>
    @endforeach
@endisland

@if($hasMore)
    @island(lazy: true, name: 'users')
        <div wire:init="loadMore">
            Loading more...
        </div>
    @endisland
@endif

public function loadMore()
{
    $this->page++;
    // Island automatically appends new items!
}</code></pre>
        </div>
    </div>
</div>
