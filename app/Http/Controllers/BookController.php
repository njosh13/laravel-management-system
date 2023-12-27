<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('creator:id,name');
        return inertia(
            'Books/Index',
            ['books' => $books]
        );
    }

    public function create()
    {
        return inertia('Books/Create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            // Define your validation rules here
        ]);

        // Create a new book
        Book::create($validatedData);

        return redirect()->route('books.index');
    }

    public function show(Book $book)
    {
        return inertia('Books/Show', ['book' => $book]);
    }

    public function edit(Book $book)
    {
        return inertia('Books/Edit', ['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        // Validate the request
        $validatedData = $request->validate([
            // Define your validation rules here
        ]);

        // Update the book
        $book->update($validatedData);

        return redirect()->route('books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
