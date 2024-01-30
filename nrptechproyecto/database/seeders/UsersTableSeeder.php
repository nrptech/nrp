<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Asegúrate de importar Hash para usar la función bcrypt

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 2,
                'name' => 'Admin',
                'surname' => 'Master',
                'email' => 'admin2@dominio.com',
                'email_verified_at' => '2024-01-28 12:34:56',
                'password' => Hash::make('12345678'),
                'idRole' => 1,
                'remember_token' => '2024-01-28 12:31:56',
                'created_at' => '2024-01-28 12:32:56',
                'updated_at' => '2024-01-28 12:32:57',
            ],
            [
                'id' => 3,
                'name' => 'Usuario',
                'surname' => 'ApellidoEjemplo',
                'email' => 'usuario@2dominio.com',
                'email_verified_at' => '2024-01-29 12:34:56',
                'password' => Hash::make('12345678'),
                'idRole' => 2,
                'remember_token' => '2024-01-29 12:31:56',
                'created_at' => '2024-01-29 12:32:56',
                'updated_at' => '2024-01-29 12:32:57',
            ]
        ]);
    }
}
