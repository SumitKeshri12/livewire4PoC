<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;

new #[Layout('layouts.app'), Title('Load More - LiveWire 4')] class extends Component {
    public int $page = 1;
    public int $perPage = 10;

    public function with(): array
    {
        $users = User::skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();

        return [
            'users' => $users,
            'hasMore' => User::count() > $this->page * $this->perPage,
        ];
    }

    public function loadMore()
    {
        $this->page++;

        // Render the controls island to update page number and button visibility
        $this->renderIsland('controls');
    }
}; ?>

<div class="p-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Load More Pagination</h1>
            <p class="text-zinc-600 dark:text-zinc-400">
                Named islands with wire:island targeting and append mode for efficient pagination.
            </p>
        </div>

        <!-- Info Card -->
        <div
            class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-lg border border-emerald-200 dark:border-emerald-800 p-6 mb-8">
            <h2 class="text-lg font-semibold text-emerald-900 dark:text-emerald-100 mb-2">How It Works</h2>
            <p class="text-sm text-emerald-800 dark:text-emerald-200 mb-3">
                The "Load More" button uses <code
                    class="px-1.5 py-0.5 bg-emerald-200 dark:bg-emerald-800 rounded">wire:island</code> to target the
                named island.
                When clicked, it loads the next page and appends the new items without re-rendering existing ones.
            </p>
            <div class="flex items-center gap-2 text-xs text-emerald-700 dark:text-emerald-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Only new items are rendered and appended to the list!</span>
            </div>
        </div>

        <!-- User Grid -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
            @island(name: 'controls')
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-1">Team Members</h2>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">Page {{ $page }} • Showing
                        {{ $perPage }} per page</p>
                </div>
            @endisland

            @island(name: 'user-grid')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($users as $user)
                        <div
                            class="bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-700 dark:to-zinc-800 rounded-lg p-6 border border-zinc-200 dark:border-zinc-600 hover:shadow-lg transition-shadow">
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-2xl mb-3">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <h3 class="font-semibold text-zinc-900 dark:text-white mb-1">{{ $user->name }}</h3>
                                <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-2">{{ $user->email }}</p>
                                <span
                                    class="px-2 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-xs font-medium rounded-full">
                                    ID: {{ $user->id }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endisland

            @island(name: 'controls')
                <!-- Load More Button -->
                @if ($hasMore)
                    <div class="mt-8 text-center">
                        <flux:button wire:click="loadMore" wire:island="user-grid"
                            class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium transition-colors inline-flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Load More Users
                        </flux:button>
                    </div>
                @else
                    <div
                        class="mt-8 text-center p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700">
                        <p class="text-sm text-zinc-600 dark:text-zinc-400">
                            🎉 All users loaded! No more to show.
                        </p>
                    </div>
                @endif
            @endisland
        </div>

        <!-- Code Example -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <h2 class="text-xl font-semibold text-zinc-900 dark:text-white mb-4">Code Example</h2>

            <div class="space-y-6">
                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Template</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>
@island(name: 'user-grid')
<div class="grid">
        @foreach ($users as $user)
<div>{{ $user->name }}</div>
@endforeach
    </div>
@endisland

@if ($hasMore)
<flux:button 
        wire:click="loadMore"
        wire:island="user-grid"
    >
        Load More
    </flux:button>
@endif
</code></pre>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Component Logic</h3>
                    <pre class="bg-zinc-900 text-zinc-100 p-4 rounded-lg overflow-x-auto text-xs"><code>public function loadMore()
{
    $this->page++;
    // Island automatically appends new items!
}</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
