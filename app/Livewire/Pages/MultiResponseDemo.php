<?php

namespace App\Livewire\Pages;

use App\Livewire\Attributes\GetJSON;
use Livewire\Component;

class MultiResponseDemo extends Component
{
    public $invoices = [
        ['id' => 1, 'amount' => 100, 'status' => 'paid'],
        ['id' => 2, 'amount' => 200, 'status' => 'pending'],
        ['id' => 3, 'amount' => 300, 'status' => 'paid'],
    ];

    #[GetJSON]
    public function render()
    {
        return view('livewire.pages.multi-response-demo');
    }
}
