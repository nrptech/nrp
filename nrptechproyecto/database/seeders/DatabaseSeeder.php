<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Category;
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

        $role1 = Role::create(["name" => "admin"]);
        $role2 = Role::create(["name" => "usuario"]);

        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@admin.com";
        $user->password = bcrypt('12345678');
        $user->surname = "Admin Admin";
        $user->role_id = 1;
        $user->assignRole($role1);
        $user->save();

        $this->call(CategoriesTableSeeder::class);
        $this->call(TaxesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(PayMethodsTableSeeder::class);

    }
}
