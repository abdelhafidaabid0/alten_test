<?php

namespace App\Core\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autorise cette requête
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
            'inventory_status' => 'required|in:INSTOCK,LOWSTOCK,OUTOFSTOCK',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'internal_reference' => 'nullable|string|unique:products,internal_reference',
            'rating' => 'nullable|integer|min:1|max:5',
        ];
    }
}
