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
        Schema::create('buku', function (Blueprint $table) {
            $table->id('buku_id'); 
            $table->string('judul', 200);
            $table->text('deskripsi');
            $table->integer('stok');
            $table->decimal('harga_jual', 10, 2);
            $table->decimal('harga_sewa', 10, 2);
            $table->unsignedBigInteger('author_id');   
            $table->unsignedBigInteger('kategori_id'); 
            $table->timestamps(); 

            
            $table->foreign('author_id')->references('author_id')->on('authors')->onDelete('cascade');
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
