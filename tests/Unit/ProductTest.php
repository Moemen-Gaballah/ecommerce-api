<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_product_successfully()
    {
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 99.99,
            'quantity' => 50,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 99.99,
            'quantity' => 50,
        ]);
    }
}
