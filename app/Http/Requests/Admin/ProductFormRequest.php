<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'name'=>['required','min:8'],
            'image'=>['image'],
            'description'=>['required','min:20'],
            'price'=> ['required','integer','min:0'],
            'categories_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(){
        return[
            "name.required" => "Veuillez entrer votre nom du produit",
            "name.min" => "Veuillez entrer le nom du produit de minimun 8 caracteres",
            "image.required" => "Veuillez entrer une image",
            "description.required" => "Veuillez entrer la description du produit",
            "description.min" => "Veuillez entrer une decription de produit de minimun 20 caracteres",
            "price.required" => "Veuillez entrer le prix du produit",
            "price.integer" => "Le prix doit etre un entier",
            "price.min" => "Le prix doit positif",
        ];
    }
}
