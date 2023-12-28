<?php

namespace App\Http\Controllers;

use App\Models\BookLoan;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
    public function index()
    {
        return inertia('BookLoans/Index', [
            'bookLoans' => BookLoan::with('book:id,name')->paginate(10),
            'statuses' => config('enums.status')
        ]);
    }

    public function updateBookLoanStatus(BookLoan $bookLoan, $status)
    {
        $bookLoan->status = $status;

        $bookLoan->save();
    }
}
