<?php

namespace Tests\Feature;

use App\Models\CustomCakeInquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomCakeInquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_submit_custom_cake_inquiry(): void
    {
        Storage::fake('public');

        $response = $this->post(route('custom-cakes.store'), [
            'customer_name' => 'Juan Dela Cruz',
            'customer_email' => 'juan@example.com',
            'customer_phone' => '6475550100',
            'event_date' => now()->addWeeks(2)->toDateString(),
            'servings' => 50,
            'flavor' => 'Ube',
            'design_notes' => 'Floral theme with gold accents',
            'reference_image' => UploadedFile::fake()->image('cake.jpg'),
        ]);

        $response->assertRedirect(route('custom-cakes.create'));

        $this->assertDatabaseHas('custom_cake_inquiries', [
            'customer_email' => 'juan@example.com',
            'flavor' => 'Ube',
            'status' => 'new',
            'servings' => 50,
        ]);

        $inquiry = CustomCakeInquiry::first();
        $this->assertNotNull($inquiry->image_path);
        Storage::disk('public')->assertExists($inquiry->image_path);
    }
}
