<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            'id' => 1,
            'name'=> 'Admin',
            'guard_name' => 'web',
            'created_at' => '2024-12-12',
            'updated_at' => '2024-12-12',
            
        ]);
    }
}
