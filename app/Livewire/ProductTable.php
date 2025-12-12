<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Footer;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Header;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class ProductTable extends PowerGridComponent
{
    use WithExport;

    public string $tableName = 'product-table-component';

    public function setUp(): array
    {
        // $this->showCheckBox();
        return [
            PowerGrid::header()
                ->showToggleColumns()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount()
        ];
    }

    public function datasource(): Builder
    {
        return Product::query();
    }

    // public function header(): array
    // {
    //     $headerArray = [];

    //     $headerArray[] = Button::add('bulk-delete')
    //         ->slot('Delete')
    //         ->class('px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs')
    //         ->dispatch('bulk-delete', ['ids' => $this->checkboxValues]);

    //     return $headerArray;
    // }

    #[On('bulk-delete')]
    public function onBulkDelete($ids): void
    {
        Product::query()->whereIn('id', $ids)->delete();
        $this->dispatch('show-toast', type: 'success', message: 'Products deleted successfully');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('price_formatted', fn(Product $model) => '$ ' . number_format($model->price, 2))
            ->add('stock')
            ->add('is_featured')
            ->add('created_at_formatted', fn(Product $model) => $model->created_at->format('d/m/Y H:i'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            Column::make('Price', 'price_formatted', 'price')
                ->sortable(),

            Column::make('Stock', 'stock')
                ->sortable(),

            Column::make('Featured', 'is_featured')
                ->toggleable(),

            Column::make('Created At', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function actions(Product $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->class('px-2 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600 text-xs')
                ->can(fn($user) => true) // Changed from authorize to can
                ->route('products.edit', ['product' => $row->id]), // This will need a route

            Button::add('delete')
                ->slot('Delete')
                ->class('px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs')
                ->dispatch('confirm-delete', ['id' => $row->id]),
        ];
    }
}
