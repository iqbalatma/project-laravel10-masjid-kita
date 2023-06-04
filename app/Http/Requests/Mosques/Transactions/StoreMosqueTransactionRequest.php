<?php

namespace App\Http\Requests\Mosques\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class StoreMosqueTransactionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "description" => "",
            "amount" => "numeric|required",
            "transaction_type_id" => "required|numeric",
            "method" => "required|in:income,expense",
            "transaction_images" => "",
            "transaction_images.*" => "max:1024|image",
        ];
    }

    public function messages():array
    {
        return [
            "transaction_images.*.uploaded" => "Your file size is too large. File greater than 1 mb are not allowed"
        ];
    }
}
