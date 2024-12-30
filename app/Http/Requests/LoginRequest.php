<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
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
        'message' => 'Login validation failed',
        'errors' => $validator->errors(),
      ],422));
    }
    public function rules(): array
    {
        return [
                // 'name'=>['required','min:5'],
                'email'=>['required','min:5','email'],
                'password'=> ['required','min:4'],
                "remember_checkbox" => ['nullable']
            ];
    }
}
