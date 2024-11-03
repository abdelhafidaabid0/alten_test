<?php

namespace App\Base;

use Illuminate\Foundation\Http\FormRequest;

class BaseFormRequest extends FormRequest {
    public function messages() : array {
        return [
            "required" => "Le champ :attribute est obligatoire.",
            "email"    => "Le champ :attribute doit être une adresse email valide.",
            "string"   => "Le champ :attribute doit être une chaîne de caractères.",
            'boolean'  => 'Le champ :attribute doit être vrai ou faux.',

            // Numeric
            "numeric"  => "Le champ :attribute doit être numéric.",
            "integer"  => "Le champ :attribute doit être un entier.",

            "unique"      => "Le champ :attribute doit être unique.",
            "regex"       => "Le format du champ :attribute est invalide.",

            // Date
            "date"        => "Format de date invalide pour :attribute. Le format correct est :format.",

            // Array
            "array"       => "Le champ :attribute doit être une array.",

            // Conditions
            "same"        => "Le champ :attribute et :other doivent correspondre.",
            "required_if" => "Le champ :attribute est requis quand :other est :value.",
            "in"          => "Le champ :attribute doit être l'un des valeurs suivante: :values.",
            "max"         => "Le champ :attribute ne doit pas dépasser :max caractères.",
            "min"         => "Le champ :attribute doit comporter au moins :min élément.",
            "between"     => "Le champ :attribute doit être compris entre :min et :max caractères.",

        ];
    }
}