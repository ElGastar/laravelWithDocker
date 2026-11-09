<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::factory(5)->create();
        Product::factory(30)->recycle($categories)->create();
    }
}
