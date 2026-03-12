<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('layouts.app'), Title('Blaze Stress Test')] class extends Component {
    public bool $useBlaze = true;
    public int $rowCount = 1000;
    public array $data = [];

    public function mount()
    {
        $this->generateData();
    }

    public function generateData()
    {
        $this->data = [];
        for ($i = 1; $i <= $this->rowCount; $i++) {
            $this->data[] = [
                'id' => $i,
                'name' => 'Product ' . $i,
                'status' => $i % 2 === 0 ? 'active' : 'inactive',
                'sku' => 'SKU-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'price' => rand(10, 1000) + (rand(0, 99) / 100),
            ];
        }
    }

    public function toggleBlaze()
    {
        $this->useBlaze = !$this->useBlaze;
    }

    public function reRender()
    {
        // Null action to trigger a re-render of the component
    }
}; ?>

<div class="p-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white mb-2">Blaze Stress Test</h1>
                <p class="text-zinc-600 dark:text-zinc-400">
                    Comparing 1,000 row renders: Standard vs Blaze Optimized.
                </p>
            </div>
            
            <div class="flex gap-4">
                <flux:button wire:click="reRender" variant="primary" icon="arrow-path">
                    Trigger Refresh
                </flux:button>
                <flux:button wire:click="toggleBlaze" variant="{{ $useBlaze ? 'primary' : 'danger' }}">
                    {{ $useBlaze ? 'Blaze Optimized' : 'Standard Rendering' }}
                </flux:button>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden shadow-sm">
            <table class="w-full text-left border-collapse">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50 border-b border-zinc-200 dark:border-zinc-700">
                    <tr>
                        <th class="px-4 py-3 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">SKU</th>
                        <th class="px-4 py-3 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-right">Price</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @foreach($data as $row)
                        @if($useBlaze)
                            <x-blaze-table-row>
                                Row {{ $row['id'] }}: {{ $row['name'] }}
                            </x-blaze-table-row>
                        @else
                            <x-standard-table-row 
                                :id="$row['id']" 
                                :name="$row['name']" 
                                :status="$row['status']" 
                                :sku="$row['sku']" 
                                :price="$row['price']" 
                                :key="'standard-'.$row['id']"
                            />
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-indigo-50 dark:bg-indigo-900/10 border border-indigo-200 dark:border-indigo-800 rounded-xl">
                <h3 class="font-bold text-indigo-900 dark:text-indigo-100 mb-2">What to look for:</h3>
                <ul class="text-xs text-indigo-800 dark:text-indigo-300 space-y-2 list-disc list-inside">
                    <li>Open <strong>Laravel Debugbar</strong> (if available).</li>
                    <li>In <strong>Standard</strong> mode, you will see 1,000+ component renders.</li>
                    <li>In <strong>Blaze</strong> mode, you will see <strong>0 renders</strong> for the rows.</li>
                    <li>Try clicking "Trigger Refresh" and notice the difference in server response time and browser painting.</li>
                </ul>
            </div>
            
            <div class="p-6 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl">
                <h3 class="font-bold text-zinc-900 dark:text-white mb-2">Technical Detail:</h3>
                <p class="text-xs text-zinc-600 dark:text-zinc-400">
                    The Blaze engine "folds" the <code class="px-1 py-0.5 bg-zinc-200 dark:bg-zinc-700 rounded">blaze-table-row</code> into the parent loop at compile-time. This eliminates the overhead of creating 1,000 Component objects and running their lifecycle methods for every single request.
                </p>
            </div>
        </div>
    </div>
</div>
