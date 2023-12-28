<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Book extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'name', 'publisher', 'isbn', 'sub_category', 'description', 'pages', 'category_id', 'added_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function bookLoans()
    {
        return $this->hasMany(BookLoan::class, 'book_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('preview');

        $this->addMediaCollection('image');
    }

    // Define a method to get images for a list of books
    public static function getBookImages($books)
    {
        // Loop through each book in the provided list
        foreach ($books as $book) {
            // Check if the book has media associated
            if ($book->media->isNotEmpty()) {
                // Retrieve the URL of the first image associated with the book
                $image = $book->getFirstMediaUrl('image');
                // Assign the image URL to a new attribute in the book model
                $book->image_url = $image;
            } else {
                // If no media is associated, set a default or null value for the image URL
                $book->image_url = null;
            }
        }

        return $books;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            function ($query) {
                $searchTerm = request('search');
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                });
            }
        );

        $query->when(
            $filters['creator'] ?? false,
            fn ($query, $creators) => $query->where(
                fn ($query) => $query->whereIn('added_by', $creators)
            )
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $categories) => $query->where(
                fn ($query) => $query->whereIn('category_id', $categories)
            )
        );

        $query->when(
            $filters['publisher'] ?? false,
            fn ($query, $publishers) => $query->where(
                fn ($query) => $query->whereIn('publisher', $publishers)
            )
        );
    }
}
