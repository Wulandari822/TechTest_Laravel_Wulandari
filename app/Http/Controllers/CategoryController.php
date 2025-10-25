<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $perPage = request()->input('perPage', 100);
        $category = Category::orderBy('kategori_id', 'asc')->paginate($perPage)->withQueryString();
        return view('category.category', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);


        Category::create([
            'nama' => $request->nama
        ]);

        return redirect()->back()->with('success', 'Category berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
    ]);

    $category = Category::findOrFail($id);
    $category->nama = $request->nama;
    $category->save();

    return redirect()->back()->with('success', 'Category berhasil diupdate!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category berhasil dihapus!');
    }
}
