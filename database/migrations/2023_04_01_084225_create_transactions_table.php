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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();
            $table->foreignId('order_id')->references('id')
                ->on('orders')
                ->restrictOnDelete();
            $table->double('artist_payable', 15, 2)->nullable();
            $table->double('artist_paid', 15, 2)->nullable();
            $table->string('artist_paid_account_number')->nullable();
            $table->double('admin_payable', 15, 2)->nullable();
            $table->double('artist_paid', 15, 2)->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
