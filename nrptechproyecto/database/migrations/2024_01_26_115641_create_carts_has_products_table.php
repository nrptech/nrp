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
        Schema::create('carts_has_products', function (Blueprint $table) {
            $table->id('idPivot');
            $table->integer('Carts_idCart');
            $table->integer('Products_idProduct');
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('Carts_idCart')->references('idCart')->on('carts');
            $table->foreign('Products_idProduct')->references('idProduct')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts_has_products');
    }
};
