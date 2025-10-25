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
        Schema::create('rating', function (Blueprint $table) {
            $table->id('rating_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('buku_id'); 
            $table->integer('rating')->check('rating >= 1 AND rating <= 5'); 
            $table->text('komentar')->nullable(); 
            $table->timestamps(); 

          
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('buku_id')->references('buku_id')->on('buku')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating');
    }
};
