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
            $table->unsignedBigInteger('idCategory');
            $table->unsignedBigInteger('idProduct');
            $table->timestamps();

            $table->foreign('idCategory')->references('idCategory')->on('categories')->onDelete('cascade');
            $table->foreign('idProduct')->references('idProduct')->on('products')->onDelete('cascade');
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
