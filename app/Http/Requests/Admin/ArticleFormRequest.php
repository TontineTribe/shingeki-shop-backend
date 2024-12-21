<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'namearticle'=>['required','min:8'],
            'imagearticle'=>['required','image'],
            'descriptionarticle'=>['required','min:20'],
        ];
    }

    public function messages(){
        return[
            "namearticle.required" => "Veuillez entrer votre nom complet",
            "namearticle.min" => "Veuillez entrer votre nom d'article de minimun 8 caracteres",
            "imagearticle.required" => "Veuillez entrer l'image de l'article",
            "decriptionarticle.required" => "Veuillez entrer votre mot de passe",
            "decriptionarticle.min" => "Veuillez entrer une decription d'article de minimun 20 caracteres",
        ];
    }
}
