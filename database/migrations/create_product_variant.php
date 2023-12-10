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
        Schema::create('product_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('listings')->onDelete('cascade');
            $table->string('colour_1')->nullable();
            $table->string('colour_2')->nullable();
            $table->string('colour_3')->nullable();
            $table->string('size_1')->nullable();
            $table->string('size_2')->nullable();
            $table->string('size_3')->nullable();
            $table->string('capacity_1')->nullable();
            $table->string('capacity_2')->nullable();
            $table->string('capacity_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant');
    }
};
