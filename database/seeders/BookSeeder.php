<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Admin');
        })->first();

        // Retrieve categories
        $fictionCategory = Category::where('name', 'Fiction')->first();
        $sfCategory = Category::where('name', 'Science Fiction')->first();
        $fantasyCategory = Category::where('name', 'Fantasy')->first();
        $mysteryCategory = Category::where('name', 'Mystery')->first();
        $nonFictionCategory = Category::where('name', 'Non-fiction')->first();

        // Create books
        Book::firstOrCreate([
            'name' => 'Book 1 Title',
            'publisher' => 'Publisher 1',
            'isbn' => '1234567890',
            'sub_category' => 'Subcategory 1',
            'description' => 'Description for Book 1',
            'pages' => 300,
            'category_id' => $fictionCategory->id,
            'added_by' => $user->id,
        ]);

        Book::firstOrCreate([
            'name' => 'Book 2 Title',
            'publisher' => 'Publisher 2',
            'isbn' => '2345678901',
            'sub_category' => 'Subcategory 2',
            'description' => 'Description for Book 2',
            'pages' => 250,
            'category_id' => $sfCategory->id,
            'added_by' => $user->id,
        ]);

        Book::firstOrCreate([
            'name' => 'Book 3 Title',
            'publisher' => 'Publisher 3',
            'isbn' => '3456789012',
            'sub_category' => 'Subcategory 3',
            'description' => 'Description for Book 3',
            'pages' => 400,
            'category_id' => $fantasyCategory->id,
            'added_by' => $user->id,
        ]);

        Book::firstOrCreate([
            'name' => 'Book 4 Title',
            'publisher' => 'Publisher 4',
            'isbn' => '4567890123',
            'sub_category' => 'Subcategory 4',
            'description' => 'Description for Book 4',
            'pages' => 320,
            'category_id' => $mysteryCategory->id,
            'added_by' => $user->id,
        ]);

        Book::firstOrCreate([
            'name' => 'Book 5 Title',
            'publisher' => 'Publisher 5',
            'isbn' => '5678901234',
            'sub_category' => 'Subcategory 5',
            'description' => 'Description for Book 5',
            'pages' => 280,
            'category_id' => $nonFictionCategory->id,
            'added_by' => $user->id,
        ]);
    }
}
