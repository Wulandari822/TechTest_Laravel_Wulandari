<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'buku_id'; 
    protected $fillable = [
        'judul',
        'deskripsi',
        'stok',
        'harga_jual',
        'harga_sewa',
        'author_id',
        'kategori_id',
        'cover',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'kategori_id');
    }

    public function transaction()
    {
        return $this->belongsToMany(Transaksi::class, 'transaksi_buku', 'buku_id', 'transaksi_id')
                    ->withPivot('jumlah', 'tipe', 'total_harga', 'tanggal_mulai', 'tanggal_akhir', 'tanggal_dikembalikan')
                    ->withTimestamps();
    }

}
