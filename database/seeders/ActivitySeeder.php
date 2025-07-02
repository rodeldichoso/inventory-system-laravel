<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $category = Category::first();
        $product = Product::first();

        Activity::create([
            'user_id' => $user->id,
            'action' => 'create',
            'subject_type' => Category::class,
            'subject_id' => $category->id,
            'description' => 'Made new category ' . $category->name,
        ]);

        Activity::create([
            'user_id' => $user->id,
            'action' => 'create',
            'subject_type' => Product::class,
            'subject_id' => $product->id,
            'description' => 'Made new product ' . $product->name,
        ]);
    }
}
