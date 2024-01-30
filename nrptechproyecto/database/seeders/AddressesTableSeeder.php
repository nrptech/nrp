<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Address;
use Illuminate\Support\Facades\DB;


class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            'idUser' => 2,
            'province' => 'ProvinciaEjemplo',
            'city' => 'CiudadEjemplo',
            'street' => 'CalleEjemplo',
            'number' => 123,
            'pc' => 12345,
            'country' => 'PaisEjemplo',
        ]);
    }
}
