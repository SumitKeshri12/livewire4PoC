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
                <flux:field variant="inline">
                    <flux:input wire:model.live="name" type="text" id="name" label="Product Name" />
                    <flux:error for="name" />
                </flux:field>
            </div>

            <!-- Description -->
            <div>
                <flux:field variant="inline">
                    <flux:textarea wire:model="description" id="description" rows="3" label="Description">
                        <flux:error for="description" />
                    </flux:textarea>
                </flux:field>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Price -->
                <div>
                    <flux:field variant="inline">
                        <flux:input wire:model.live="price" type="number" step="0.01" id="price" label="Price ($)" />
                        <flux:error for="price" />
                    </flux:field>
                </div>

                <!-- Stock -->
                <div>
                    <flux:field variant="inline">
                        <flux:input wire:model.live="stock" type="number" id="stock" label="Stock Quantity" />
                        <flux:error for="stock" />
                    </flux:field>
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
            <div>
                <flux:field variant="inline">
                    <flux:checkbox wire:model.live="is_featured" label="Feature this product" />
                    <flux:error for="is_featured" />
                </flux:field>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                <a href="{{ route('products.index') }}" wire:navigate
                    class="px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-md hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-700">
                    Cancel
                </a>
                <flux:button type="submit" variant="primary" color="indigo">
                    Create Product
                </flux:button>
            </div>
        </form>
    </div>
</div>
