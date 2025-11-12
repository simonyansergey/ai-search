<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $shirts = Category::create(['name' => 'Shirts', 'slug' => 'shirts']);
        $pants = Category::create(['name' => 'Pants', 'slug' => 'pants']);
        $shoes = Category::create(['name' => 'Shoes', 'slug' => 'shoes']);

        Product::create([
            'name' => 'Red Striped Casual Shirt',
            'slug' => 'red-striped-casual-shirt',
            'description' => 'Comfortable cotton shirt with white stripes, perfect for summer',
            'price' => 29.99,
            'image' => 'products/red-striped-shirt.jpg',
            'category_id' => $shirts->id,
            'color' => 'red',
            'pattern' => 'striped',
            'season' => 'summer',
            'material' => 'cotton',
            'size' => 'M',
        ]);

        Product::create([
            'name' => 'Blue Plain Formal Shirt',
            'slug' => 'blue-plain-formal-shirt',
            'description' => 'Professional blue shirt for office wear',
            'price' => 39.99,
            'image' => 'products/blue-formal-shirt.jpg',
            'category_id' => $shirts->id,
            'color' => 'blue',
            'pattern' => 'plain',
            'season' => 'all-season',
            'material' => 'polyester',
            'size' => 'L',
        ]);

        Product::create([
            'name' => 'Black Casual Pants',
            'slug' => 'black-casual-pants',
            'description' => 'Comfortable black pants for everyday wear',
            'price' => 49.99,
            'image' => 'products/black-pants.jpg',
            'category_id' => $pants->id,
            'color' => 'black',
            'pattern' => 'plain',
            'season' => 'all-season',
            'material' => 'cotton',
            'size' => 'M',
        ]);

        Product::create([
            'name' => 'White Summer Sneakers',
            'slug' => 'white-summer-sneakers',
            'description' => 'Lightweight sneakers perfect for summer activities',
            'price' => 59.99,
            'image' => 'products/white-sneakers.jpg',
            'category_id' => $shoes->id,
            'color' => 'white',
            'pattern' => 'plain',
            'season' => 'summer',
            'material' => 'canvas',
            'size' => '10',
        ]);
    }
}
