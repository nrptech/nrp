<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
        ]);
        Role::create([
                'id' => 2,
                'name' => 'User',
                'guard_name' => 'web',
        ]);
       
    }
}
