<?php

namespace App\Core\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageContactRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Autorise cette requête
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'message' => 'required|string|max:300',
        ];
    }
}
