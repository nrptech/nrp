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
                'idRole' => 1,
                'type' => 'Admin',
                'idUser' => '1',
                'created_at' => '2017-07-23',
                'updated_at' => '2017-07-23'
            ],
            [
                'idRole' => 1,
                'type' => 'Admin',
                'idUser' => '2',
                'created_at' => '2017-07-23',
                'updated_at' => '2017-07-23'
            ]
        ]);
    }
}
