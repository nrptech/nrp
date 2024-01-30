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
            $table->id();
            $table->unsignedBigInteger('idOrder');
            $table->unsignedBigInteger('idProduct');
            $table->timestamps();

            $table->foreign('idOrder')->references('id')->on('orders');
            $table->foreign('idProduct')->references('id')->on('products');
           
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
