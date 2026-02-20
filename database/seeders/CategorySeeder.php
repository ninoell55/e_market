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
        Category::create(['category_name' => 'Shoes', 'slug' => 'shoes']);
        Category::create(['category_name' => 'Clothes', 'slug' => 'clothes']);
        Category::create(['category_name' => 'Accessories', 'slug' => 'accessories']);
    }
}
