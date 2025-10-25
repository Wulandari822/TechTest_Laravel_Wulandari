<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Book;
use App\Models\User;

class TransactionController extends Controller
{
    public function index()
    {
        $allTransactions = Transaction::with('book', 'user')->get();
        $doneTransactions = Transaction::with('book', 'user')->where('status', 'selesai')->get();
        $prosesTransactions = Transaction::with('book', 'user')->where('status', 'diproses')->get();
        $fineTransactions = Transaction::with('book', 'user')->where('status', 'denda')->get();

        return view('detail-transaksi', compact(
            'allTransactions', 
            'doneTransactions', 
            'prosesTransactions', 
            'fineTransactions'
        ));
    }

    public function store(Request $request)
    {
        $book = Book::findOrFail($request->buku_id);

        if ($book->stok < $request->jumlah) {
        return back()->with('error', 'Stok tidak cukup untuk transaksi ini.');
    }

        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'buku_id' => 'required|exists:buku,buku_id',
            'tipe' => 'required|in:sell,rent',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date',
        ]);

        $status = $request->tipe === 'sell' ? 'selesai' : 'diproses';

        Transaction::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'tipe' => $request->tipe,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'status' => $status,
        ]);

        $book->stok -= $request->jumlah;
        $book->save();

        if ($request->tipe === 'sell') {
            return redirect()->route('books')->with('rating_id', $request->buku_id);

        }

        return redirect()->back()->with('success', 'Transaksi berhasil dibuat.');
    }
}
