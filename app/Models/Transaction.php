<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tipe',
        'jumlah',
        'total_harga',
        'tanggal_mulai',
        'tanggal_akhir',
        'tanggal_dikembalikan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'buku_id', 'buku_id');
    }




    
    }

