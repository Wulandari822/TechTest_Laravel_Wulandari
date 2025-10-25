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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('transaksi_id');
            $table->unsignedBigInteger('user_id'); 
            $table->enum('tipe', ['sell', 'rent']); 
            $table->integer('jumlah'); 
            $table->decimal('total_harga', 10, 2); 
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_akhir')->nullable(); 
            $table->date('tanggal_dikembalikan')->nullable(); 
            $table->enum('status', ['selesai', 'diproses', 'denda'])->default('diproses'); 
            $table->timestamps();

            
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
