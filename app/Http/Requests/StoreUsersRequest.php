<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\GenderType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          "first_name" => "required|string|max:255",
          "last_name" => "string|max:255",
          "email" => "required|email|max:100",
          "password" => "required|string|max:255",
          "address" => "string||max:255",
          "phone" => "string|max:255",
          "phone_2" => "string|max:255",
          "postal_code" => "string|max:50",
          "birth_date" => "date",
          "gender" => ["required", new Enum(GenderType::class)],
        ];
    }
}
