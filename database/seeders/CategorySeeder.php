<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Fiction']);
        Category::firstOrCreate(['name' => 'Science Fiction']);
        Category::firstOrCreate(['name' => 'Fantasy']);
        Category::firstOrCreate(['name' => 'Mystery']);
        Category::firstOrCreate(['name' => 'Non-fiction']);
    }
}
