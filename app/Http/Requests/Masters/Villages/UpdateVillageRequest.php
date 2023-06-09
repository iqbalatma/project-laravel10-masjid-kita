<?php

namespace App\Http\Requests\Masters\Villages;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVillageRequest extends FormRequest
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
            "name" => "required|max:255",
            "postcode" => "required|max:5",
            "subdistrict_id" => "required|numeric"
        ];
    }
}
