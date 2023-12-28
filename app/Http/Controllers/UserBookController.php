<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    public function allBooks()
    {

        // Fetch a list of books
        $books = Book::with('category:id,name')->filter(request(["search", "publisher", "category"]))->get(); // Assuming 'media' is the relationship to your media

        // Get images for the list of books
        $books = Book::getBookImages($books);

        return inertia('UserBooks/All', [
            'books' => $books,
            'categories' => Category::select(['id', 'name'])->get(),
            'publishers' => Book::pluck('publisher')->unique()
        ]);
    }
}
