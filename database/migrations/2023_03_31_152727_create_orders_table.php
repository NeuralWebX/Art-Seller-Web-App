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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->foreignId('author_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();
            $table->foreignId('customer_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();
            $table->double('amount', 15, 2)->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('order_number')->unique();
            $table->string('currency')->nullable();
            $table->string('order_status')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
