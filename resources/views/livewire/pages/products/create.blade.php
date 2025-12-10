<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use App\Models\Product;
use Illuminate\Http\Request;

new #[Layout('layouts.app'), Title('Create Product')] class extends Component {
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

    // Observer Pattern: Reacting to state changes
    public function updated($property)
    {
        if (in_array($property, ['price', 'stock'])) {
            $p = is_numeric($this->price) ? (float) $this->price : 0;
            $s = is_numeric($this->stock) ? (int) $this->stock : 0;
            $this->estimatedValue = $p * $s;
        }
    }

    public function store(Request $request)
    {
        $validated = $this->validate();

        $product = Product::create($validated);

        // Multi-Response Demo
        if ($request->wantsJson()) {
            $this->skipRender(); // Important for pure JSON response in Livewire context?
            // Actually, returning a response object from a method usually interrupts standard flow.
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Product created (JSON Response)',
                    'data' => $product,
                ],
                201,
            );
        }

        $this->dispatch('show-toast', type: 'success', message: 'Product created successfully!');
        $this->redirect(route('products.index'), navigate: true);
    }
}; ?>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('products.index') }}" wire:navigate
            class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
            ← Back to Products
        </a>
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">Create Product</h1>
    </div>

    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-700 p-6">
        <form wire:submit="store" class="space-y-6">
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

            <!-- Observer Demo: Calculated Value -->
            <div
                class="p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-md border border-indigo-100 dark:border-indigo-800">
                <p class="text-sm text-indigo-700 dark:text-indigo-300 font-medium">
                    Estimated Total Value (Observer Demo):
                    <span class="text-lg font-bold ml-2">${{ number_format($estimatedValue, 2) }}</span>
                </p>
                <p class="text-xs text-indigo-500 dark:text-indigo-400 mt-1">Calculates automatically as you type!</p>
            </div>

            <!-- Is Featured -->
            <div class="flex items-center">
                <input wire:model="is_featured" id="is_featured" type="checkbox"
                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-zinc-300 rounded">
                <label for="is_featured" class="ml-2 block text-sm text-zinc-900 dark:text-zinc-300">
                    Feature this product
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <a href="{{ route('products.index') }}" wire:navigate
                    class="px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-md hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-700">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Product
                    <svg wire:loading class="animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
