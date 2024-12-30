<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartUpdateRequest extends FormRequest
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
        'message' => 'Register validation failed',
        'errors' => $validator->errors(),
      ],422));
    }
    public function rules(): array
    {
        return [
              'quantity'=>'required|min:1|integer',
              'city_id'=>'required|exists:cities,id',
            ];
    }
}
