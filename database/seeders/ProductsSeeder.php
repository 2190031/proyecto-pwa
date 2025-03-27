<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        // Ensure the table exists before seeding
        if (Schema::hasTable('product')) {
            DB::table('product')->insert([
                [
                    'name' => 'Sample Product 1',
                    'description' => 'This is a description for Sample Product 1.',
                    'price' => 19.99,
                    'stock' => 50,
                    'category_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Sample Product 2',
                    'description' => 'This is a description for Sample Product 2.',
                    'price' => 29.99,
                    'stock' => 30,
                    'category_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Sample Product 3',
                    'description' => 'This is a description for Sample Product 3.',
                    'price' => 39.99,
                    'stock' => 20,
                    'category_id' => 1, // No category assigned
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
