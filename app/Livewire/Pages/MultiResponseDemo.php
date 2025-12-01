<?php

namespace App\Livewire\Pages;

use App\Livewire\Attributes\GetJSON;
use App\Livewire\Attributes\PostJSON;
use App\Livewire\Attributes\GetPDF;
use App\Models\Invoice;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

#[GetJSON]
#[PostJSON]
#[GetPDF]
class MultiResponseDemo extends Component
{
    #[Validate]
    public $invoice_number = '';
    
    #[Validate]
    public $customer_name = '';
    
    #[Validate]
    public $amount = '';
    
    #[Validate]
    public $status = 'pending';

    public function rules()
    {
        return [
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
            'customer_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,overdue',
        ];
    }

    #[Computed]
    public function invoices()
    {
        return Invoice::latest()->get();
    }

    public function createInvoice()
    {
        $validated = $this->validate();
        
        Invoice::create($validated);
        
        $this->reset(['invoice_number', 'customer_name', 'amount']);
        $this->status = 'pending';
        
        session()->flash('success', 'Invoice created successfully!');
    }

    public function render()
    {
        return view('livewire.pages.multi-response-demo');
    }
}

