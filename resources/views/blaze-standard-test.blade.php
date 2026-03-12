<x-layouts::app title="Standard Blade Blaze Test">
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Standard Blade Blaze Test</h1>
        <table class="w-full border border-zinc-200">
            <tbody>
                @foreach([1, 2, 3] as $id)
                    <x-blaze-table-row blaze:fold>
                        Standard Blade ID: {{ $id }}
                    </x-blaze-table-row>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts::app>
