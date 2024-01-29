<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'idUser' => 1,
            'name' => 'UsuarioUno',
            'email' => 'usuario@dominio.com',
            'surname' => 'ApellidoEjemplo',
            'email' => 'usuario@dominio.com',
            'password' => bcrypt('contraseña123'),
            'email_verified_at' => '2024-01-29 12:34:56'
        ]);
    }
}
