<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ActivitySeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\OrderItemSeeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles if they do not exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        // Create default admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );
        $adminUser->assignRole($adminRole);

        // Create default staff user
        $staffUser = User::firstOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff User',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );
        $staffUser->assignRole($staffRole);

        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            ActivitySeeder::class,
        ]);
    }
}
