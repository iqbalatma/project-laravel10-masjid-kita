<?php

namespace App\Http\Requests\Masters\Mosques;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMosqueRequest extends FormRequest
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
            "latitude" => "required",
            "longitude" => "required",
            "village_id" => "required|numeric",
        ];
    }
}
