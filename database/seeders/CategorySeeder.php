<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Safe delete without violating foreign key constraints
        Category::query()->delete();

        // Add your custom categories here if needed
        $categories = [
            // Example:
            // [
            //     'name' => 'Call of Duty',
            //     'image' => 'https://example.com/images/cod.png',
            //     'description' => 'Call of Duty is a popular first-person shooter game.',
            // ],
        ];

        if (!empty($categories)) {
            Category::insert($categories);
        }
    }
}
