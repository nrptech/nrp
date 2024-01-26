<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'idUser' => 1,
            'Carts_idCart' => null,
            'name' => 'NombreEjemplo',
            'surname' => 'ApellidoEjemplo',
            'email' => 'usuario@dominio.com',
            'password' => bcrypt('contraseña123'),
            'Userscol' => 'ValorEjemplo',
        ]);
    }
}
