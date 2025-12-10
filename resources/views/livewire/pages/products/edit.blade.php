<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use App\Models\Product;
use Illuminate\Http\Request;

new #[Layout('layouts.app'), Title('Edit Product')] class extends Component {
    public Product $product;

    #[Rule('required|min:3')]
    public $name = '';

    #[Rule('nullable')]
    public $description = '';

    #[Rule('required|numeric|min:0')]
    public $price = '';

    #[Rule('required|integer|min:0')]
    public $stock = '';

    #[Rule('boolean')]
    public $is_featured = false;

    public $estimatedValue = 0;

    // Load More Demo Data
    public int $logCount = 2;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->is_featured = $product->is_featured;
        $this->calculateValue();
    }

    public function updated($property)
    {
        if (in_array($property, ['price', 'stock'])) {
            $this->calculateValue();
        }
    }

    public function calculateValue()
    {
        $p = is_numeric($this->price) ? (float) $this->price : 0;
        $s = is_numeric($this->stock) ? (int) $this->stock : 0;
        $this->estimatedValue = $p * $s;
    }

    public function update()
    {
        $validated = $this->validate();

        $this->product->update($validated);

        $this->dispatch('show-toast', type: 'success', message: 'Product updated successfully!');
        $this->redirect(route('products.index'), navigate: true);
    }

    public function loadMoreLogs()
    {
        // Simulate loading more data
        sleep(0.5);
        $this->logCount += 2;

        // In a real app we'd fetch from DB.
        // Here we just use the island render to append dummy logs.
        $newLogs = [['date' => now()->subMinutes(rand(1, 60))->format('Y-m-d H:i'), 'action' => 'Updated stock #' . $this->logCount], ['date' => now()->subMinutes(rand(60, 120))->format('Y-m-d H:i'), 'action' => 'Price check #' . ($this->logCount + 1)]];

        $this->renderIsland('logs', mode: 'append', with: ['logs' => $newLogs]);
    }
}; ?>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('products.index') }}" wire:navigate
            class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
            ← Back to Products
        </a>
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">Edit Product: {{ $product->name }}</h1>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Edit Form -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
            <form wire:submit="update" class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Product
                        Name</label>
                    <input wire:model.live="name" type="text" id="name"
                        class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-900 dark:border-zinc-700 dark:text-white sm:text-sm">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description"
                        class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Description</label>
                    <textarea wire:model="description" id="description" rows="3"
                        class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-900 dark:border-zinc-700 dark:text-white sm:text-sm"></textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Price
                            ($)</label>
                        <input wire:model.live="price" type="number" step="0.01" id="price"
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-900 dark:border-zinc-700 dark:text-white sm:text-sm">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Stock
                            Quantity</label>
                        <input wire:model.live="stock" type="number" id="stock"
                            class="mt-1 block w-full rounded-md border-zinc-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-900 dark:border-zinc-700 dark:text-white sm:text-sm">
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Observer Demo -->
                <div
                    class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-md border border-indigo-100 dark:border-indigo-800">
                    <p class="text-sm text-indigo-700 dark:text-indigo-300 font-medium">
                        Estimated Total Value: <span
                            class="text-lg font-bold ml-2">${{ number_format($estimatedValue, 2) }}</span>
                    </p>
                </div>

                <!-- Is Featured -->
                <div class="flex items-center">
                    <input wire:model="is_featured" id="is_featured" type="checkbox"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-zinc-300 rounded">
                    <label for="is_featured" class="ml-2 block text-sm text-zinc-900 dark:text-zinc-300">
                        Feature this product
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                    <a href="{{ route('products.index') }}" wire:navigate
                        class="px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-md hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-700">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Product
                    </button>
                </div>
            </form>
        </div>

        <!-- Load More Demo: Product Logs -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
            <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-4">Product History (Island Load More)</h3>

            <div class="space-y-4 mb-4">
                @island(name: 'logs')
                    @isset($logs)
                        @foreach ($logs as $log)
                            <div
                                class="flex items-start gap-3 p-3 bg-zinc-50 dark:bg-zinc-900 rounded-lg border border-zinc-100 dark:border-zinc-800">
                                <div class="w-2 h-2 mt-2 bg-indigo-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm text-zinc-800 dark:text-zinc-200">{{ $log['action'] }}</p>
                                    <p class="text-xs text-zinc-500">{{ $log['date'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Initial Logs -->
                        <div
                            class="flex items-start gap-3 p-3 bg-zinc-50 dark:bg-zinc-900 rounded-lg border border-zinc-100 dark:border-zinc-800">
                            <div class="w-2 h-2 mt-2 bg-indigo-500 rounded-full"></div>
                            <div>
                                <p class="text-sm text-zinc-800 dark:text-zinc-200">Created product</p>
                                <p class="text-xs text-zinc-500">{{ $product->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    @endisset
                @endisland
            </div>

            <button wire:click="loadMoreLogs"
                class="w-full py-2 bg-zinc-100 dark:bg-zinc-700 text-zinc-600 dark:text-zinc-300 text-sm font-medium rounded-md hover:bg-zinc-200 dark:hover:bg-zinc-600 transition">
                Load More History
            </button>
        </div>
    </div>
</div>
