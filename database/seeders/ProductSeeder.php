<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $category = Category::first();
        $supplier = Supplier::first();

        Product::create([
            'name' => 'Espresso Beans',
            'sku' => 'ESP-001',
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'price' => 500.99,
            'stock' => 100,
            'description' => 'High-quality espresso beans sourced from the best farms.',
        ]);
    }
}
