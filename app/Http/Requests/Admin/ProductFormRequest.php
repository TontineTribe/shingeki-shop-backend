<?php

namespace App\Http\Requests\admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
    public function failedValidation(Validator $validator){
      throw new HttpResponseException(response()->json([
        'success' => false,
        'status' => 422,
        'message' => 'Creating or updating a new product failed',
        'errors' => $validator->errors(),
      ],422));
    }

    public function rules(): array
    {
        return [
            'name'=>['required','min:8','unique:products,name'],
            'image'=>['image'],
            'description'=>['required','min:20'],
            'price'=> ['required','integer','min:0'],
            'categories_id' => 'required|exists:categories,id',
        ];
    }

}
