<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices = [
            ['invoice_number' => 'INV-001', 'customer_name' => 'John Drexler', 'amount' => 1554.50, 'status' => 'paid'],
            ['invoice_number' => 'INV-002', 'customer_name' => 'Sarah Connor', 'amount' => 2340.00, 'status' => 'pending'],
            ['invoice_number' => 'INV-003', 'customer_name' => 'Michael Scott', 'amount' => 890.75, 'status' => 'paid'],
            ['invoice_number' => 'INV-004', 'customer_name' => 'Pam Beesly', 'amount' => 1200.00, 'status' => 'overdue'],
            ['invoice_number' => 'INV-005', 'customer_name' => 'Jim Halpert', 'amount' => 3500.25, 'status' => 'paid'],
            ['invoice_number' => 'INV-006', 'customer_name' => 'Dwight Schrute', 'amount' => 750.00, 'status' => 'pending'],
            ['invoice_number' => 'INV-007', 'customer_name' => 'Angela Martin', 'amount' => 1875.50, 'status' => 'paid'],
            ['invoice_number' => 'INV-008', 'customer_name' => 'Kevin Malone', 'amount' => 425.00, 'status' => 'overdue'],
            ['invoice_number' => 'INV-009', 'customer_name' => 'Oscar Martinez', 'amount' => 2100.00, 'status' => 'paid'],
            ['invoice_number' => 'INV-010', 'customer_name' => 'Stanley Hudson', 'amount' => 950.75, 'status' => 'pending'],
            ['invoice_number' => 'INV-011', 'customer_name' => 'Phyllis Vance', 'amount' => 1650.00, 'status' => 'paid'],
            ['invoice_number' => 'INV-012', 'customer_name' => 'Creed Bratton', 'amount' => 300.00, 'status' => 'overdue'],
            ['invoice_number' => 'INV-013', 'customer_name' => 'Meredith Palmer', 'amount' => 1100.50, 'status' => 'paid'],
            ['invoice_number' => 'INV-014', 'customer_name' => 'Ryan Howard', 'amount' => 2750.00, 'status' => 'pending'],
            ['invoice_number' => 'INV-015', 'customer_name' => 'Kelly Kapoor', 'amount' => 825.25, 'status' => 'paid'],
        ];

        foreach ($invoices as $invoice) {
            Invoice::updateOrCreate(
                ['invoice_number' => $invoice['invoice_number']],
                $invoice
            );
        }
    }
}
