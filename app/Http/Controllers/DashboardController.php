<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $topBooks = Book::leftJoin('rating', 'buku.buku_id', '=', 'rating.buku_id')
            ->select('buku.judul', DB::raw('COUNT(rating.rating_id) as total_voter'))
            ->groupBy('buku.buku_id', 'buku.judul')
            ->orderByDesc('total_voter')
            ->take(10)
            ->get();

        $topAuthors = Author::leftJoin('buku', 'authors.author_id', '=', 'buku.author_id')
            ->leftJoin('rating', 'buku.buku_id', '=', 'rating.buku_id')
            ->select(
                'authors.nama',
                DB::raw('IFNULL(AVG(rating.rating),0) as avg_rating'),
                DB::raw('COUNT(rating.rating_id) as total_votes')
    )
    ->groupBy('authors.author_id', 'authors.nama')
    ->orderByDesc('avg_rating')
    ->take(10)
    ->get();

     return view('index', compact('topBooks', 'topAuthors'));

    }
}
