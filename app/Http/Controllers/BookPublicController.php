<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class BookPublicController extends Controller
{

    public function index()
    {
        $latestBooks = Book::latest()
            ->take(3)
            ->get();

        $categories = Category::all();

        $allBook = Book::with('favorites')->get();
        return view('user.home', compact('latestBooks', 'categories', 'allBook'));
    }

    public function getBooks()
    {
        $books = Book::with('favorites')->get();

        $userId = Auth::id();

        $data = $books->map(function ($book) use ($userId) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'image' => $book->image,
                'favorited' => $userId && $book->favorites->where('user_id', $userId)->count() > 0,
            ];
        });

        return response()->json($data);
    }

    public function bookGaleryImages()
    {
        $bookImages = Book::all();
        return view('user.galery-book', compact('bookImages'));
    }

    public function showBooksWithCategory()
    {
        // Menghindari N+1 Problem
        $books = Book::with('category')->get();

        return view('user.books', compact('books'));
    }


    public function showBooksWithCategoryNPlusOne()
    {
        $books = Book::all(); // hanya mengambil buku

        // Saat di view nanti, setiap `$book->category->name` akan men-trigger query baru per book
        return view('user.books', compact('books'));
    }
}
