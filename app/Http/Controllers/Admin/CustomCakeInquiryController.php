<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomCakeInquiry;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CustomCakeInquiryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Inquiries/Index', [
            'inquiries' => CustomCakeInquiry::query()->latest()->get(),
        ]);
    }

    public function show(CustomCakeInquiry $inquiry): Response
    {
        return Inertia::render('Admin/Inquiries/Show', [
            'inquiry' => $inquiry->load('user'),
        ]);
    }

    public function update(Request $request, CustomCakeInquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,quoted,accepted,declined'],
        ]);

        $inquiry->update($validated);

        return back()->with('success', 'Inquiry status updated.');
    }
}
