<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class BookLoan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'book_id', 'loan_date', 'due_date', 'extended', 'return_date', 'status', 'extension_date', 'penalty_amount', 'penalty_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
