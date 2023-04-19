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
        Schema::create('exibition_submittions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exibition_id')->constrained()->cascadeOnDelete();
            $table->string('artist_name');
            $table->string('artwork_title');
            $table->string('artwork_number');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exibition_submittions');
    }
};