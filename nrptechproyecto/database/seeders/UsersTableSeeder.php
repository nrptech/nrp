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
