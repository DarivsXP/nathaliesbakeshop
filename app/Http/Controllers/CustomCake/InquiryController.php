<?php

namespace App\Http\Controllers\CustomCake;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomCakeInquiryRequest;
use App\Models\CustomCakeInquiry;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class InquiryController extends Controller
{
    public function create(): Response
    {
        $sampleCakes = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->whereHas('category', fn ($q) => $q->where('slug', 'cakes'))
            ->orderByDesc('is_featured')
            ->get();

        return Inertia::render('CustomCake/Create', [
            'sampleCakes' => $sampleCakes,
        ]);
    }

    public function store(StoreCustomCakeInquiryRequest $request)
    {
        $validated = $request->validated();
        $imagePath = null;

        if ($request->hasFile('reference_image')) {
            $imagePath = $request->file('reference_image')->store('inquiries', 'public');
        }

        CustomCakeInquiry::create([
            'user_id' => $request->user()?->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'event_date' => $validated['event_date'],
            'servings' => $validated['servings'],
            'flavor' => $validated['flavor'],
            'design_notes' => $validated['design_notes'] ?? null,
            'image_path' => $imagePath,
            'status' => 'new',
        ]);

        return redirect()->route('custom-cakes.create')->with('success', 'Your custom cake inquiry has been submitted! We will be in touch soon.');
    }
}
