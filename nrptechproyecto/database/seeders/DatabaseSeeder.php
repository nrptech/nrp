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
        $image4 = new Image();
        $image5 = new Image();
        $image6 = new Image();
        $image7 = new Image();

        $user = new User();
        $product = new Product();
        $product2 = new Product();
        $product3= new Product();
        $product4 = new Product();
        $product5 = new Product();
        $tax = new Tax();

        $image->product_id=1;
        $image->url="images/nrp.webp";
        $image2->product_id=2;
        $image2->url="images/nrp.webp";
        $image3->product_id=1;
        $image3->url="images/xokas.jpg";
        $image4->product_id=3;
        $image4->url="images/prros.jpg";
        $image5->product_id=3;
        $image5->url="images/patrocinador.png";
        $image6->product_id=3;
        $image6->url="images/xokas.jpg";
        $image7->product_id=4;
        $image7->url="images/patrocinador.png";

        $tax->taxName="IVA";
        $tax->amount=10;

        $product->name="Productoria";
        $product->price= 129;
        $product->description="Es muy bueno!!";
        $product->discount=25;
        $product->tax_id=1;
        $product->color="ROJO";
        $product->stock=100;
        $product->specs="Muy poderoso";
        $product->features="Hace muchas cosas";
        
        $product2->name="Pruebax";
        $product2->price= 78;
        $product2->description="No es tan bueno";
        $product2->discount=0;
        $product2->tax_id=1;
        $product2->color="VERDE";
        $product2->stock=100;
        $product2->specs="Ta bien";
        $product2->features="Se maneja guay";
        
        $product3->name="Perro pajero";
        $product3->price= 1125;
        $product3->description="Es muy Pajero!!";
        $product3->discount=0;
        $product3->tax_id=1;
        $product3->color="Blanco";
        $product3->stock=1;
        $product3->specs="Está todo el puto dia matandose a pajas";
        $product3->features="Tambien es capaz de mantener relaciones sexuales con otros perros";
        
        $product4->name="Don kamaron";
        $product4->price= 120;
        $product4->description="No es tan bueno";
        $product4->discount=90;
        $product4->tax_id=1;
        $product4->color="VERDE";
        $product4->stock=1450;
        $product4->specs="En don camarón tenemos el mejor lugar para comer en familia o en pareja, los mejores mariscos solo los encuentras aquí en el restaurante don camarón, también encuentras pollos y costillas asadas al estilo patzcuaro,y las micheladas al 2x1 todos los días, nuestro horario es de 12pm a 7 pm, estamos en el entronque por la entrada de autozone, don camarón el mejor lugar para comer en familia o en pareja.";
        $product4->features="Mariscos, Pollos, Costillas asadas al estilo patzcuaro, Micheladas";

        $product5->name="Perro pajero";
        $product5->price= 1125;
        $product5->description="Es muy Pajero!!";
        $product5->discount=0;
        $product5->tax_id=1;
        $product5->color="Blanco";
        $product5->stock=1;
        $product5->specs="Está todo el puto dia matandose a pajas";
        $product5->features="Tambien es capaz de mantener relaciones sexuales con otros perros";

        $user->name="Admin";
        $user->email="admin@admin.com";
        $user->password=bcrypt('12345678');
        $user->surname="Admin Admin";
        $user->role_id=1;
        
        
        $user->assignRole($role1);
        $tax->save();
        $product->save();
        $product2->save();
        $product3->save();
        $product4->save();
        $product5->save();
        $user->save();
        $image->save();
        $image2->save();
        $image3->save();
        $image4->save();
        $image5->save();
        $image6->save();
        $image7->save();

        \App\Models\User::factory(10)->create();
        
    }
}
