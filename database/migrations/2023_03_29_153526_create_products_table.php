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
            $table->string('product_name');
            $table->foreignId('category_id')->references('id')
                ->on('categories')
                ->restrictOnDelete();
            $table->foreignId('user_id')->references('id')
                ->on('users')
                ->restrictOnDelete();
            $table->string('product_details');
            $table->string('product_number');
            $table->double('product_price', 8, 2);
            $table->string('product_image');
            $table->boolean('product_status')->default(1);
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
