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
            $table->id();
            $table->unsignedBigInteger('idWishlist');
            $table->unsignedBigInteger('idProduct');
            $table->timestamps();

            $table->foreign('idWishlist')->references('id')->on('wishlists')->onDelete('cascade');
            $table->foreign('idProduct')->references('id')->on('products')->onDelete('cascade');        
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
