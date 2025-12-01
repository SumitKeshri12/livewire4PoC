<?php

namespace App\Livewire\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class PostJSON extends FormatAware
{
    protected $methods = ['POST'];
    protected $accepts = ['application/json'];

    protected function response($component, $view)
    {
        // Get the JSON payload from the request
        $data = request()->json()->all();
        
        // Populate component properties directly
        foreach ($data as $key => $value) {
            if (property_exists($component, $key)) {
                $component->$key = $value;
            }
        }
        
        // Call the createInvoice method which handles validation and saving
        try {
            $component->createInvoice();
            
            // Get the latest created invoice
            $invoice = \App\Models\Invoice::where('invoice_number', $data['invoice_number'])->first();
            
            return response()->json([
                'success' => true,
                'message' => 'Invoice created successfully',
                'data' => $invoice ? $invoice->toArray() : $data,
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
