<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->foreign('coupon_id')->references('id')->on('coupons')->nullable()->change();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['tax_id']);
            $table->dropForeign(['coupon_id']);
        });
    }
};
