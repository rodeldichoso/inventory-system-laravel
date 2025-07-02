<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Supplier A',
            'contact' => '123-456-7890',
            'email' => 'supplierA@example.com',
            'address' => '123 Supplier St, City, Country',
        ]);
    }
}
