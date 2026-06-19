<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Shop/Contact');
    }

    public function store(StoreContactRequest $request)
    {
        // Demo: log contact message; email integration in Phase 5
        logger()->info('Contact form submission', $request->validated());

        return back()->with('success', 'Thank you for reaching out! We will get back to you within 24 hours.');
    }
}
