<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::create([
            'name' => 'BlackFriday',
            'active' => false,
        ]);

        Coupon::create([
            'name' => 'WhiteMonday',
        ]);

        Coupon::create([
            'name' => 'Orutamerp',
        ]);

        Coupon::create([
            'name' => 'OxeS',
        ]);
    }

}
