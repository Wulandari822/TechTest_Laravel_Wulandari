<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,buku_id',
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'nullable|string',
        ]);

        Rating::create([
            'user_id' => auth()->user()->user_id,
            'buku_id' => $request->buku_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);


        return redirect()->back()->with('success', 'Terima kasih telah memberikan rating!');
    }
}
