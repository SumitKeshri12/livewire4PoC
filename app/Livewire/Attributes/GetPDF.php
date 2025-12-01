<?php

namespace App\Livewire\Attributes;

use Spatie\Browsershot\Browsershot;
use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_METHOD)]
class GetPDF extends FormatAware
{
    protected $accepts = ['application/pdf'];

    protected function response($component, $view)
    {
        // Render the view to HTML
        $html = view('pdf.invoice-pdf', [
            'invoices' => $this->getInvoicesData($component),
        ])->render();
        
        // Generate PDF using Browsershot
        try {
            $pdf = Browsershot::html($html)
                ->setNodeBinary('C:\Program Files\nodejs\node.exe')
                ->setNpmBinary('C:\Program Files\nodejs\npm.cmd')
                ->setOption('landscape', false)
                ->margins(10, 10, 10, 10)
                ->format('A4')
                ->pdf();
            
            return response($pdf, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="invoices.pdf"');
                
        } catch (\Exception $e) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('PDF Generation Failed: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error($e->getTraceAsString());

            // Fallback if Browsershot fails (e.g., Node.js not installed)
            return response()->json([
                'error' => 'PDF generation failed',
                'message' => $e->getMessage(),
                'note' => 'Browsershot requires Node.js and Puppeteer. Run: npm install -g puppeteer',
            ], 500);
        }
    }
    
    private function getInvoicesData($component)
    {
        // Try to get invoices from public properties or computed properties
        $reflection = new \ReflectionClass($component);
        
        // Check for public invoices property
        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if ($property->getName() === 'invoices') {
                $property->setAccessible(true);
                return $property->getValue($component);
            }
        }
        
        // Check for computed property
        if (method_exists($component, 'getInvoicesProperty')) {
            return $component->invoices;
        }
        
        // Fallback to all invoices
        return \App\Models\Invoice::all();
    }
}
