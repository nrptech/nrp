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
                'idUser' => 1,
                'name' => 'Admin',
                'email' => 'admin@dominio.com',
                'surname' => 'Master',
                'password' => Hash::make('contraseña123'), // Utiliza Hash::make para encriptar la contraseña
                'email_verified_at' => '2024-01-29 12:34:56'
            ],
            [
                'idUser' => 2,
                'name' => 'Usuario',
                'email' => 'usuario@dominio.com',
                'surname' => 'ApellidoEjemplo',
                'password' => Hash::make('contraseña123'),
                'email_verified_at' => '2024-01-29 12:34:56'
            ]
        ]);
    }
}
