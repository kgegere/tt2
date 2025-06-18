<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'address' => 'Admin address',
            'password' => bcrypt('adminpassword'),
        ]);
        User::factory()->create([
            'name' => 'Seller',
            'email' => 'seller@example.com',
            'role' => 'seller',
            'address' => 'Seller address',
            'password' => bcrypt('sellerpassword'),
        ]);

        Category::create(['name' => 'Home decor']);
        Category::create(['name' => 'Kitchenware']);
        Category::create(['name' => 'Electronics']);
        Category::create(['name' => 'Clothing']);
        Category::create(['name' => 'Sports equipment']);
        Category::create(['name' => 'Garden tools']);
        Category::create(['name' => 'Furniture']);
        Category::create(['name' => 'Other']);

        Listing::create([
            'title' => 'Fish dish',
            'description' => 'A porcelain dish with a picture of a fish on it. Be careful not to break it!',
            'price' => 20,
            'image' => 'listings/1.jpg',
            'is_purchased' => true,
            'user_id' => 1,
            'category_id' => 2,
        ]);

        Listing::create([
            'title' => 'Salt lamp',
            'description' => 'Meant to be looked at, not licked. Found this at a thrift shop, where most people get these, just like you',
            'price' => 10,
            'image' => 'listings/2.jpg',
            'is_purchased' => false,
            'user_id' => 2,
            'category_id' => 1,
        ]);

        
    }
}
