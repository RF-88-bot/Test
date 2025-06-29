<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->filter(request(['search']))->paginate(2);
        $category = request('category');

        if ($category) {
            $books = $books->filter(function ($book) use ($category) {
                return $book['category'] === $category;
            });
        }

        $categories = $books->pluck('category')->unique();

        return view('books.buku', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::find($id);
        return view('books.detailBuku', compact('book'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('books.tambahBuku');
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
            'category' => 'required',
            'year' => 'required|integer',
            'publisher' => 'required',
            'image' => 'image|file|max:1024'
        ];

        // Pesan error kustom
        $messages = [
            'title.required' => 'Judul buku wajib diisi.',
            'author.required' => 'Nama penulis tidak boleh kosong.',
            'category.required' => 'Kategori buku harus diisi.',
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
        return view('books.edit_buku', compact('book'));
    }
    public function update(Request $request, Book $book)
    {
        // dd($book);
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'year' => 'required|integer',
            'publisher' => 'required',
            'image' => 'image|file|max:1024'
        ];

        $messages = [
            'title.required' => 'Judul buku wajib diisi.',
            'author.required' => 'Nama penulis tidak boleh kosong.',
            'category.required' => 'Kategori buku harus diisi.',
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
