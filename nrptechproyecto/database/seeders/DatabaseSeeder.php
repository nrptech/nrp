<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role1= Role::create(["name" => "admin"]);
        $role2= Role::create(["name" => "usuario"]);

        $user = new User();
        $product = new Product();
        $tax = new Tax();

        $tax->taxName="IVA";
        $tax->amount=10;

        $product->name="Productoria";
        $product->price= 129;
        $product->description="Es muy bueno!!";
        $product->discount=1;
        $product->idTax=1;
        $product->color="ROJO";
        $product->stock=100;
        $product->specs="Muy poderoso";
        $product->features="Hace muchas cosas";

        $user->name="Admin";
        $user->email="admin@admin.com";
        $user->password=bcrypt('12345678');
        $user->surname="Admin Admin";
        $user->idRole=1;

        $user->assignRole($role1);
        $tax->save();
        $product->save();
        $user->save();

    }
}
