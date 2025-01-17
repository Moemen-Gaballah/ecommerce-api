<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'Laptop', 'price' => 1500.00, 'quantity' => 10],
            ['name' => 'Smartphone', 'price' => 700.00, 'quantity' => 25],
            ['name' => 'Headphones', 'price' => 150.00, 'quantity' => 50],
            ['name' => 'Monitor', 'price' => 300.00, 'quantity' => 15],
            ['name' => 'Keyboard', 'price' => 50.00, 'quantity' => 100],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
