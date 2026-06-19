<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CustomCakeInquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_place_demo_order(): void
    {
        $category = Category::create([
            'name' => 'Empanadas',
            'slug' => 'empanadas',
            'sort_order' => 1,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Beef Empanada',
            'slug' => 'beef-empanada',
            'description' => 'Test product',
            'price' => 4.50,
            'is_active' => true,
        ]);

        $response = $this->post(route('checkout.store'), [
            'customer_name' => 'Maria Santos',
            'customer_email' => 'maria@example.com',
            'customer_phone' => '4165550199',
            'fulfillment_type' => 'pickup',
            'items' => [
                ['product_id' => $product->id, 'quantity' => 3],
            ],
        ]);

        $order = Order::first();
        $this->assertNotNull($order);
        $response->assertRedirect(route('checkout.confirmation', $order->order_number));

        $this->assertDatabaseHas('orders', [
            'customer_email' => 'maria@example.com',
            'payment_status' => 'demo',
            'status' => 'pending',
            'total' => 13.50,
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_name' => 'Beef Empanada',
            'quantity' => 3,
        ]);
    }
}
