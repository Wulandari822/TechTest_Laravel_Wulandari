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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('detail_id'); 
            $table->unsignedBigInteger('transaksi_id'); 
            $table->unsignedBigInteger('buku_id'); 
            $table->integer('jumlah'); 
            $table->decimal('harga', 10, 2); 
            $table->decimal('total_harga', 10, 2); 
            $table->timestamps();

            
            $table->foreign('transaksi_id')->references('transaksi_id')->on('transaksi')->onDelete('cascade');
            $table->foreign('buku_id')->references('buku_id')->on('buku')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
