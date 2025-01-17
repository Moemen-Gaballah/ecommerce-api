<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_places_an_order_successfully()
    {
        // Create a user
        $user = User::factory()->create();

        // Create products
        $product1 = Product::factory()->create(['quantity' => 10]);
        $product2 = Product::factory()->create(['quantity' => 5]);

        // Simulate user authentication
        $this->actingAs($user, 'sanctum');

        // Place an order
        $response = $this->postJson('/api/orders', [
            'products' => [
                ['id' => $product1->id, 'quantity' => 2],
                ['id' => $product2->id, 'quantity' => 1],
            ],
        ]);

        $response->assertStatus(201);

        // Assert database updates
        $this->assertDatabaseHas('orders', ['user_id' => $user->id]);
        $this->assertDatabaseHas('order_product', [
            'product_id' => $product1->id,
            'quantity' => 2,
        ]);
        $this->assertDatabaseHas('order_product', [
            'product_id' => $product2->id,
            'quantity' => 1,
        ]);

        // Assert quantity deduction
        $this->assertDatabaseHas('products', [
            'id' => $product1->id,
            'quantity' => 8,
        ]);
        $this->assertDatabaseHas('products', [
            'id' => $product2->id,
            'quantity' => 4,
        ]);
    }
}
