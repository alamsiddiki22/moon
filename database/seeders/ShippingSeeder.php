<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
            'shipping_type' => 'Inside City',
            'charge' => '60',
            'created_at' => now()
        ]);
        DB::table('shippings')->insert([
            'shipping_type' => 'Outside City',
            'charge' => '120',
            'created_at' => now()
        ]);
        DB::table('shippings')->insert([
            'shipping_type' => 'Zero Shipping Fee',
            'charge' => 0,
            'created_at' => now()
        ]);
    }
}
