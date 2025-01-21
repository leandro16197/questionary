<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LifePurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('life_purchase_options')->insert([
            ['lives_quantity' => 1, 'price' => 10.00],
            ['lives_quantity' => 3, 'price' => 25.00],
            ['lives_quantity' => 5, 'price' => 40.00],
        ]);
    }
}
