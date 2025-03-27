<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PayMethodSeeder extends Seeder
{
    public function run()
    {
        DB::table('pay_method')->insert([
            [
                'name' => 'Credit Card',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PayPal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Transfer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cash',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
