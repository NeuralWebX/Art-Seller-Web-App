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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')
                ->on('orders')
                ->restrictOnDelete();
            $table->foreignId('product_id')->references('id')
                ->on('products')
                ->restrictOnDelete();
            $table->double('quantity', 15, 2)->nullable();
            $table->double('unit_price', 15, 2)->nullable();
            $table->double('sub_total', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};