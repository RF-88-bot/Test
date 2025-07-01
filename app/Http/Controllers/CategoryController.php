<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use \Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('books.kategori_buku', compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'nullable|mimes:svg,xml|max:512',
        ]);

        if ($request->hasFile('image')) {
            $svgPath = $request->file('image')->store('category-images');
            $validated['image'] = $svgPath;
        }
        Category::create($validated);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $request->merge(['_edit_modal' => 'true']); // agar bisa buka kembali modal edit jika validasi gagal

        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'image' => 'nullable|mimes:svg,xml|max:512',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {
            $svgPath = $request->file('image')->store('category-images');
            $validated['image'] = $svgPath;

            if ($category->image) {
                Storage::delete($category->image);
            }
        }

        $category->update($validated);

        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil diupdate!');
    }
    public function destroy(Category $category)
    {
        // Hapus gambar dari storage jika ada
        if ($category->image) {
            Storage::delete($category->image);
        }

        // Hapus semua buku yang terkait
        foreach ($category->books as $book) {
            // Hapus gambar buku (jika ada)
            if ($book->image) {
                Storage::delete($book->image);
            }
        }

        // Hapus data buku dari database
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Kategori buku berhasil dihapus.');
    }
}
