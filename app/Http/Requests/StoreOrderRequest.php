<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'fulfillment_type' => ['required', 'in:pickup,delivery'],
            'shipping_address' => ['required_if:fulfillment_type,delivery', 'nullable', 'array'],
            'shipping_address.street' => ['required_if:fulfillment_type,delivery', 'nullable', 'string', 'max:255'],
            'shipping_address.city' => ['required_if:fulfillment_type,delivery', 'nullable', 'string', 'max:100'],
            'shipping_address.province' => ['required_if:fulfillment_type,delivery', 'nullable', 'string', 'max:100'],
            'shipping_address.postal_code' => ['required_if:fulfillment_type,delivery', 'nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:99'],
            'items.*.variant' => ['nullable', 'string', 'max:100'],
        ];
    }
}
