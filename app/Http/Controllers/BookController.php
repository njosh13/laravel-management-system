<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $books = Book::with('creator:id,name', 'category:id,name')->paginate(10);

        return inertia(
            'Books/Index',
            ['books' => $books]
        );
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::select(['id', 'name'])->get();
        return inertia(
            'Books/CreateAndEditForm',
            [
                'categories' => $categories
            ]
        );
    }

    public function store(Request $request)
    {
        // Validate the request
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'publisher' => 'required|string|max:50',
            'isbn' => 'required|string|max:50|unique:books,isbn',
            'sub_category' => 'nullable|string|max:100',
            'description' => 'required|string',
            'pages' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user_id = auth()->id();
        $formData['added_by'] = $user_id;

        Book::create($formData);

        return redirect()->route('admin.books.index');
    }

    public function show(Book $book)
    {

        return inertia('Books/Show', [
            'book' => $book
        ]);
    }

    public function edit(Book $book)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::select(['id', 'name'])->get();

        return inertia(
            'Books/CreateAndEditForm',
            [
                'book' => $book,
                'categories' => $categories
            ]
        );
    }

    public function update(Request $request, Book $book)
    {
        // Validate the request
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'publisher' => 'required|string|max:50',
            'isbn' => 'required|string|max:50',
            'sub_category' => 'nullable|string|max:100',
            'description' => 'required|string',
            'pages' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Update the book
        $book->update($formData);

        return redirect()->route('admin.books.index');
    }

    public function destroy(Book $book)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $book->delete();
        return redirect()->route('admin.books.index');
    }
}
