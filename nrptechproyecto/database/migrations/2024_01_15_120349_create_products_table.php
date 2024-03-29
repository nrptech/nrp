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
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->text('description');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('tax_id');
            $table->string('color', 45)->default('')->nullable();
            $table->integer('stock');
            $table->boolean("visible")->default(true);
            $table->text('specs')->default('')->nullable();
            $table->text('features')->default('')->nullable();
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
