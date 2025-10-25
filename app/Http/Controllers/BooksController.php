<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;


class BooksController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('kategori_id'); 

        $books = Book::with('author', 'category')
            ->when($search, function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhereHas('author', function($q2) use ($search) {
                        $q2->where('nama', 'like', "%{$search}%");
                });
        })
            ->when($categoryId, function($q) use ($categoryId) {
                $q->where('kategori_id', $categoryId);
        })
            ->paginate(10)
            ->appends($request->all()); 

        $authors = Author::all();
        $categories = Category::all();

        return view('book.books', compact('books', 'authors', 'categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'harga_sewa' => 'required|numeric|min:0',
            'author_id' => 'required|exists:authors,author_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
        $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Book::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga_jual' => $request->harga_jual,
            'harga_sewa' => $request->harga_sewa,
            'author_id' => $request->author_id,
            'kategori_id' => $request->kategori_id,
            'cover' => $coverPath,
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }



    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'harga_sewa' => 'required|numeric|min:0',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $updateData['cover'] = $coverPath;
        }


        $book->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'harga_jual' => $request->harga_jual,
            'harga_sewa' => $request->harga_sewa,
        ]);

        return redirect()->back()->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover && \Storage::disk('public')->exists($book->cover)) {
        \Storage::disk('public')->delete($book->cover);
        }

        $book->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus!');
    }
}
