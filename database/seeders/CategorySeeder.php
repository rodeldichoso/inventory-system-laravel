<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $creatorId = User::first();
        $categories = ['Drinks', 'Snack', 'Equipment', 'Beans'];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'description' => 'This is a description for ' . $category,
                'created_by' => $creatorId->id, // Assuming the first user is the creator
            ]);
        }
    }
}
