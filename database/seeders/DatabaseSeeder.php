<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\InvoiceSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\KanbanSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            InvoiceSeeder::class,
            ProductSeeder::class,
            KanbanSeeder::class,
        ]);
    }
}
