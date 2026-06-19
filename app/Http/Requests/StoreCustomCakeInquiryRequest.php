<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomCakeInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'event_date' => ['required', 'date', 'after:today'],
            'servings' => ['required', 'integer', 'min:1', 'max:500'],
            'flavor' => ['required', 'string', 'max:255'],
            'design_notes' => ['nullable', 'string', 'max:2000'],
            'reference_image' => ['nullable', 'image', 'max:4096'],
        ];
    }
}
