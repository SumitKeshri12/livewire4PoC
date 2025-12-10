<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Product;

new #[Layout('layouts.app'), Title('Products - Livewire 4')] class extends Component {
    public function updateFeaturedOrder($items)
    {
        // In a real app, update 'order' column.
        // Here we just simulate a delay and toast.
        sleep(0.5);
        $this->dispatch('show-toast', type: 'success', message: 'Featured products reordered!');
    }

    public function deleteProduct($id)
    {
        Product::find($id)?->delete();
        $this->dispatch('pg:eventRefresh-default'); // Refresh Powergrid
        $this->dispatch('show-toast', type: 'success', message: 'Product deleted successfully');
    }

    public function refreshStats()
    {
        sleep(1); // Demo Smart Loading
        // Updating component state automatically refreshes islands that depend on it
    }

    public function with(): array
    {
        return [
            'featuredProducts' => Product::where('is_featured', true)->get(),
            'totalValue' => Product::sum(\DB::raw('price * stock')),
            'lowStockCount' => Product::where('stock', '<', 10)->count(),
        ];
    }
}; ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Top Stats Island with Nesting -->
    @island(name: 'stats')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Total Inventory Value</h3>
                <p class="text-2xl font-bold text-zinc-900 dark:text-white mt-1">${{ number_format($totalValue, 2) }}</p>

                <!-- Nested Island -->
                @island(name: 'last-updated')
                    <p class="text-xs text-zinc-400 mt-2">Updated: {{ now()->format('H:i:s') }}</p>
                @endisland
            </div>

            <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Low Stock Items</h3>
                <p class="text-2xl font-bold text-orange-600 dark:text-orange-400 mt-1">{{ $lowStockCount }}</p>
            </div>

            <div
                class="bg-white dark:bg-zinc-800 rounded-lg p-6 border border-zinc-200 dark:border-zinc-700 shadow-sm flex items-center justify-center">
                <!-- Smart Loading Demo -->
                <button wire:click="refreshStats"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition flex items-center gap-2">
                    <span wire:loading.remove>Refresh Stats</span>
                    <span wire:loading>Refreshing...</span>
                </button>
            </div>
        </div>
    @endisland

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Main Content: Powergrid Table -->
        <div class="lg:col-span-3">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">Products</h1>
                <a href="{{ route('products.create') }}" wire:navigate
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                    + New Product
                </a>
            </div>

            <div
                class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                <livewire:product-table />
            </div>
        </div>

        <!-- Sidebar: Wire Sort & Blaze -->
        <div class="lg:col-span-1">
            <h2 class="text-lg font-bold text-zinc-900 dark:text-white mb-4">Featured (Sortable)</h2>
            <div class="bg-zinc-100 dark:bg-zinc-900 rounded-lg p-4">
                <p class="text-xs text-zinc-500 mb-4">Drag to reorder (Wire Sort Demo)</p>

                @blaze
                    <ul wire:sort="updateFeaturedOrder" class="space-y-2">
                        @forelse($featuredProducts as $product)
                            <li wire:sort.item="{{ $product->id }}" wire:key="featured-{{ $product->id }}"
                                class="bg-white dark:bg-zinc-800 p-3 rounded border border-zinc-200 dark:border-zinc-700 shadow-sm cursor-move flex items-center gap-2">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                                <span
                                    class="text-sm font-medium text-zinc-700 dark:text-zinc-200 truncate">{{ $product->name }}</span>
                            </li>
                        @empty
                            <li class="text-sm text-zinc-500 text-center py-4">No featured products.</li>
                        @endforelse
                    </ul>
            </div>
        </div>
    </div>

    <!-- x-modalable Delete Confirmation -->
    <!-- Powergrid might handle this internally but for demo let's add a listener -->
    <div x-data="{ open: false, id: null }" x-on:confirm-delete.window="open = true; id = $event.detail.id" x-show="open"
        style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-2xl p-6 max-w-sm w-full mx-4"
            @click.outside="open = false">
            <h3 class="text-lg font-bold text-red-600 mb-2">Delete Product?</h3>
            <p class="text-zinc-600 dark:text-zinc-400 mb-6">Are you sure you want to delete this product? This action
                cannot be undone.</p>
            <div class="flex justify-end gap-3">
                <button @click="open = false"
                    class="px-4 py-2 text-zinc-600 dark:text-zinc-300 font-medium hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-md">Cancel</button>
                <button @click="$wire.deleteProduct(id); open = false"
                    class="px-4 py-2 bg-red-600 text-white font-medium hover:bg-red-700 rounded-md">Delete</button>
            </div>
        </div>
    </div>
</div>
