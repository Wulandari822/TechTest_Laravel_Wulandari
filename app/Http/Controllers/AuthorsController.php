<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorsController extends Controller
{
    public function index()
    {

       $perPage = request()->input('perPage', 10);
       $authors = Author::orderBy('author_id', 'asc')->paginate($perPage)->withQueryString();
       return view('author.author', compact('authors'));

    }

    public function store(Request $request)
    {
        $request->validate([
        'nama' => 'required'
    ]);

        Author::create([
        'nama' => $request->nama
    ]);

        return redirect()->back()->with('success', 'Author berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'nama' => 'required'
    ]);

        $author = Author::findOrFail($id);
        $author->nama = $request->nama;
        $author->save();

        return redirect()->back()->with('success', 'Author berhasil diupdate!');
    }


    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->back()->with('success', 'Author berhasil dihapus!');
    }
}
