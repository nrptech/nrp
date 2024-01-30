<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TaxesTableSeeder::class); 
        $this->call(UsersTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(RolesPermissionsSeeder::class);
    }
}
