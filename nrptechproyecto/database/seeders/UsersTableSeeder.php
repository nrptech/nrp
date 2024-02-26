<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {

        User::create([
            'name' => 'Rafa',
            'email' => 'rafa@hotmail.com',
            'password' => Hash::make('rafa'),
            'surname' => 'Pedrosa Castelo',
            'role_id' => 2,
        ]);
    }
}
