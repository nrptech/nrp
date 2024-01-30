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
            $table->unsignedBigInteger('idCart');
            $table->unsignedBigInteger('idProduct');
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('idCart')->references('idCart')->on('carts')->onDelete('cascade');
            $table->foreign('idProduct')->references('idProduct')->on('products')->onDelete('cascade');

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
