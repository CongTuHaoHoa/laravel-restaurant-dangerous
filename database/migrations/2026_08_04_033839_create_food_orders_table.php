<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('food_orders', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('quantity');
            $table->integer('price');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('food_id');
            $table->foreign('food_id')->references('FOD_ID')->on('foods');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('food_orders');
    }
};
