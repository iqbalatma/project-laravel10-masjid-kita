<?php

namespace App\Http\Requests\Profiles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            "name" => "max:128",
            "phone" => "max:32",
            "address" => "max:1000",
            "profile_image" => 'max:1024|image'
        ];
    }

    public function messages():array
    {
        return [
            "profile_image.uploaded" => "Your file size is too large. File greater than 1 mb are not allowed"
        ];
    }
}
