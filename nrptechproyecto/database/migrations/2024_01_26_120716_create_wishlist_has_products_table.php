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
        Schema::create('wishlist_has_products', function (Blueprint $table) {
            $table->id('idPivot');
            $table->integer('Wishlist_idWishlist');
            $table->integer('Products_idProduct');
            $table->timestamps();

            $table->foreign('Wishlist_idWishlist')->references('idWishlist')->on('wishlist');
            $table->foreign('Products_idProduct')->references('idProduct')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_has_products');
    }
};
