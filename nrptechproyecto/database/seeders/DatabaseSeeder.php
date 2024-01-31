<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(TaxesTableSeeder::class); 
        // $this->call(RolesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        // $this->call(AddressesTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        // $this->call(RolesPermissionsSeeder::class);

        $role1= Role::create(["name" => "admin"]);
        $role2= Role::create(["name" => "usuario"]);

        $image = new Image();
        $image2 = new Image();
        $image3 = new Image();
        $user = new User();
        $product = new Product();
        $product2 = new Product();
        $tax = new Tax();

        $image->product_id=1;
        $image->url="images/nrp.webp";
        $image2->product_id=2;
        $image2->url="images/nrp.webp";
        $image3->product_id=1;
        $image3->url="images/xokas.jpg";

        $tax->taxName="IVA";
        $tax->amount=10;

        $product->name="Productoria";
        $product->price= 129;
        $product->description="Es muy bueno!!";
        $product->discount=1;
        $product->tax_id=1;
        $product->color="ROJO";
        $product->stock=100;
        $product->specs="Muy poderoso";
        $product->features="Hace muchas cosas";
        
        $product2->name="Productoria2";
        $product2->price= 78;
        $product2->description="No es tan bueno";
        $product2->discount=1;
        $product2->tax_id=1;
        $product2->color="VERDE";
        $product2->stock=100;
        $product2->specs="Ta bien";
        $product2->features="Se maneja guay";
        
        $user->name="Admin";
        $user->email="admin@admin.com";
        $user->password=bcrypt('12345678');
        $user->surname="Admin Admin";
        $user->role_id=1;
        
        
        $user->assignRole($role1);
        $tax->save();
        $product->save();
        $product2->save();
        $user->save();
        $image->save();
        $image2->save();
        $image3->save();

        \App\Models\User::factory(10)->create();
        
    }
}
