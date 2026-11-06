<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\Auth\Models\Role;
use App\Modules\Products\Models\Category;
use App\Modules\Products\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Roles
        $adminRole = Role::create(['name' => 'Administrator', 'slug' => 'admin']);
        $userRole  = Role::create(['name' => 'User', 'slug' => 'user']);

        // 2. Seed Admin User
        $admin = User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);
        $admin->roles()->attach($adminRole);

        // 3. Seed Categories
        $categories = Category::factory()->count(10)->create();

        // 4. Seed Products
        $products = Product::factory()->count(50)->create();

        // 5. Attach Categories to Products
        $products->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray(),
                ['added_at' => now()]
            );
        });
    }
}