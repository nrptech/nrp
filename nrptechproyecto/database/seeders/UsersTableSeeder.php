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
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@dominio.com',
                'email_verified_at' => '2024-01-28 12:34:56',
                'password' => Hash::make('contraseña123'),
                'remember_token' => '2024-01-28 12:31:56',
                'created_at' => '2024-01-28 12:32:56',
                'updated_at' => '2024-01-28 12:32:57',
                'surname' => 'Master',
            ],
            [
                'id' => 2,
                'name' => 'Usuario',
                'email' => 'usuario@dominio.com',
                'email_verified_at' => '2024-01-29 12:34:56',
                'password' => Hash::make('contraseña123'),
                'remember_token' => '2024-01-29 12:31:56',
                'created_at' => '2024-01-29 12:32:56',
                'updated_at' => '2024-01-29 12:32:57',
                'surname' => 'ApellidoEjemplo',
            ]
        ]);
    }
}
