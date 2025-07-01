<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')
            ->latest()
            ->filter(request(['search']))
            ->paginate(5);

        return view('books.buku', compact('books'));
    }

    public function show($id)
    {
        $book = Book::find($id);
        return view('books.detailBuku', compact('book'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $categories = Category::all();
        return view('books.tambahBuku', compact('categories'));
    }

    // Proses simpan buku baru
    public function store(Request $request)
    {
        // dd($request);
        // Validasi aturan
        // return $request->file('image')->store('book-images');

        $rules = [
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'year' => 'required|integer',
            'publisher' => 'required',
            'image' => 'image|file|max:1024'
        ];

        // Pesan error kustom
        $messages = [
            'title.required' => 'Judul buku wajib diisi.',
            'author.required' => 'Nama penulis tidak boleh kosong.',
            'category_id.required' => 'Kategori buku harus diisi.',
            'year.required' => 'Tahun terbit harus diisi.',
            'year.integer' => 'Tahun terbit harus berupa angka.',
            'publisher.required' => 'Nama penerbit tidak boleh kosong.',
            'image.image'    => 'File yang diunggah harus berupa gambar.',
            'image.file'     => 'File tidak valid.',
            'image.max'      => 'Ukuran gambar maksimal 1MB.',
        ];

        // Lakukan validasi
        $data = $request->validate($rules, $messages);

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('book-images');
        }

        // Simpan data ke database
        Book::create($data);

        return redirect()->route('admin.books')->with('success', 'Data buku berhasil ditambahkan.');
    }
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit_buku', compact('book', 'categories'));
    }
    public function update(Request $request, Book $book)
    {
        // dd($book);
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'year' => 'required|integer',
            'publisher' => 'required',
            'image' => 'image|file|max:1024'
        ];

        $messages = [
            'title.required' => 'Judul buku wajib diisi.',
            'author.required' => 'Nama penulis tidak boleh kosong.',
            'category.required_id' => 'Kategori buku harus diisi.',
            'year.required' => 'Tahun terbit harus diisi.',
            'year.integer' => 'Tahun terbit harus berupa angka.',
            'publisher.required' => 'Nama penerbit tidak boleh kosong.',
            'image.image'    => 'File yang diunggah harus berupa gambar.',
            'image.file'     => 'File tidak valid.',
            'image.max'      => 'Ukuran gambar maksimal 1MB.',
        ];

        // Validasi data
        $data = $request->validate($rules, $messages);

        // Jika ada gambar baru diupload
        if ($request->file('image')) {
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('book-images');

            // Hapus gambar lama jika ada (opsional)
            if ($book->image) {
                Storage::delete($book->image);
            }
        }

        // Update data buku
        $book->update($data);

        return redirect()->route('admin.books')->with('success', 'Data buku berhasil diperbarui.');
    }
    public function destroy(Book $book)
    {
        // Hapus gambar dari storage jika ada
        if ($book->image) {
            Storage::delete($book->image);
        }

        // Hapus data buku dari database
        $book->delete();

        return redirect()->route('admin.books')->with('success', 'Data buku berhasil dihapus.');
    }
}
