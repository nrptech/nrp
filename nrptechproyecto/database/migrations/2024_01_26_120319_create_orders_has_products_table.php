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
        Schema::create('orders_has_products', function (Blueprint $table) {
            $table->id('idPivot');
            $table->integer('Orders_idOrder');
            $table->integer('Products_idProduct');
            $table->timestamps();

            $table->foreign('Orders_idOrder')->references('idOrder')->on('orders');
            $table->foreign('Products_idProduct')->references('idProduct')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_has_products');
    }
};
