<?php

namespace App\Core\Products;

use App\Base\BaseFormRequest;

class StoreProductRequest extends BaseFormRequest {
    public function authorize() {
        return true; // Autorise cette requête
    }



    public function rules() {
        return [
            'name'               => 'required|string|max:255',
            'code'               => 'required|alpha_num|max:30',
            'price'              => 'required|numeric',
            'quantity'           => 'required|integer',
            'category'           => 'required|string|max:255',
            'inventory_status'   => 'required|in:INSTOCK,LOWSTOCK,OUTOFSTOCK',
            'description'        => 'nullable|string',
            'image'              => 'nullable|url',
            'internal_reference' => 'nullable|string|unique:products,internal_reference',
            'rating'             => 'nullable|integer|min:1|max:5',
        ];
    }
}
