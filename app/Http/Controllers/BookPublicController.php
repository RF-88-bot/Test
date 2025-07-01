<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookPublicController extends Controller
{

    public function index()
    {
        $latestBooks = Book::latest()
            ->take(3)
            ->get();

        $categories = Category::all();

        $allBook = Book::all();
        return view('user.home', compact('latestBooks', 'categories', 'allBook'));
    }
}
