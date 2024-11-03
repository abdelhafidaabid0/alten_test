<?php

namespace App\Core\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autorise cette requête
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
            'category' => 'sometimes|required|string|max:255',
            'inventory_status' => 'sometimes|required|in:INSTOCK,LOWSTOCK,OUTOFSTOCK',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
            'internal_reference' => 'nullable|string|unique:products,internal_reference,' . $this->product,
            'rating' => 'nullable|integer|min:1|max:5',
        ];
    }
}
