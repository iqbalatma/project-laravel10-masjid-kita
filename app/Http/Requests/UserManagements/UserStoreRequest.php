<?php

namespace App\Http\Requests\UserManagements;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
            "name" => "required",
            "phone" => "",
            "address" => "",
            "email" =>  [Rule::unique("users", "email")->whereNull("deleted_at"), "email", "required"],
            "password" => "confirmed|required",
            "roles" => ""
        ];
    }
}
