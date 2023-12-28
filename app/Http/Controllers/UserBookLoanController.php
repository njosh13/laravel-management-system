<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookLoan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserBookLoanController extends Controller
{
    public function index()
    {
        // Retrieve book loans for the current authenticated user

        $bookLoans = BookLoan::with('book:id,name')->where('user_id', auth()->user()->id)->paginate(10);

        // Return view with the user's book loans
        return inertia('UserBookLoans/Index', [
            'bookLoans' => $bookLoans
        ]);
    }

    public function create()
    {
        return inertia('UserBookLoans/CreateAndEditForm', [
            'books' => Book::select(['id', 'name'])
                ->whereDoesntHave('bookLoans', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->get()
        ]);
    }

    public function store(Request $request)
    {

        $formData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date',

        ]);

        $formData['user_id'] = auth()->user()->id;
        $formData['loan_date'] = Carbon::today();
        $formData['status'] = 'Pending';

        BookLoan::create($formData);

        return redirect()->route('my-books.index');
    }
}
