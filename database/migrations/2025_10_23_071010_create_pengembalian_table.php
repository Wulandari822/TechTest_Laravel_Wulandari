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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id('pengembalian_id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->unsignedBigInteger('transaksi_id'); 
            $table->unsignedBigInteger('buku_id'); 
            $table->date('tanggal_pengembalian'); 
            $table->integer('keterlambatan')->default(0); 
            $table->decimal('denda', 10, 2)->default(0); 
            $table->enum('status', ['tepat waktu', 'terlambat'])->default('tepat waktu'); 
            $table->timestamps();

            
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('transaksi_id')->references('transaksi_id')->on('transaksi')->onDelete('cascade');
            $table->foreign('buku_id')->references('buku_id')->on('buku')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian');
    }
};
