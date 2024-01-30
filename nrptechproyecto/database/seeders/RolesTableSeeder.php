<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'Administrador',
                'created_at' => '2017-07-22',
                'updated_at' => '2017-07-22'
            ],
            [
                'id' => 2,
                'name' => 'User',
                'guardname' => 'Usuario',
                'created_at' => '2017-07-23',
                'updated_at' => '2017-07-23'
            ]
        ]);
    }
}
