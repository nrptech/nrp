<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories_has_products', function (Blueprint $table) {
            $table->id('idPivot');
            $table->integer('Categories_idCategorie');
            $table->integer('Products_idProduct');
            $table->timestamps();

            $table->foreign('Categories_idCategorie')->references('idCategorie')->on('categories');
            $table->foreign('Products_idProduct')->references('idProduct')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_has_products');
    }
};
