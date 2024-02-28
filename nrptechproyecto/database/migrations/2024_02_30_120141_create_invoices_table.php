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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('payMethod_id');
            $table->unsignedBigInteger('address_id');
            $table->integer('total');
            $table->date('date');
            $table->timestamps();
            
            $table->foreign('payMethod_id')->references('id')->on('pay_methods');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
