<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Sample Product 1',
            'description' => 'This is a sample product description.',
            'price' => 29.99,
            'image' => 'https://via.placeholder.com/250x250',
        ]);

        Product::create([
            'name' => 'Sample Product 2',
            'description' => 'Another sample product description.',
            'price' => 49.99,
            'image' => 'https://via.placeholder.com/250x250',
        ]);
    }
}
