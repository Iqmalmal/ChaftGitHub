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
        Schema::create('pending_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //relate  to user table
            $table->unsignedBigInteger('product_id'); //relate to listing table
            $table->string('group_id'); //give a unique id for each group of product
            $table->string('recipient')->nullable(); 
            $table->string('product_name');
            $table->decimal('price', 8, 2); //price per unit
            $table->integer('quantity');
            $table->string('variant')->nullable();
            $table->longText('images')->nullable();
            $table->decimal('totalPrice', 8, 2)->nullable(); //price * quantity
            $table->string('status')->nullable(); //Status: Unpaid, Paid, Cancelled
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_order');
    }
};
