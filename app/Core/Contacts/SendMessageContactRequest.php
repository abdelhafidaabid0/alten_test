<?php

namespace App\Core\Contacts;

use App\Base\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageContactRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true; // Autorise cette requête
    }

    public function rules()
    {
        return [
            'nom' => 'sometimes',
            'email' => 'required|email',
            'sujet' => 'sometimes|max:150',
            'message' => 'required|string|max:300',
        ];
    }
}
