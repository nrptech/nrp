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
        Schema::create('products', function (Blueprint $table) {
            $table->id('idProduct');
            $table->integer('name');
            $table->integer('price');
            $table->string('description', 255);
            $table->integer('discount');
            $table->integer('Taxes_idTax');
            $table->string('color', 45);
            $table->integer('stock');
            $table->string('specs', 255);
            $table->string('features', 255);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
