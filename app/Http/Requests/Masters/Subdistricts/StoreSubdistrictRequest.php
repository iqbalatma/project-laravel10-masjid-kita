<?php

namespace App\Http\Requests\Masters\Subdistricts;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubdistrictRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "code" => "required|unique:subdistricts,code,NULL,id,deleted_at,NULL",
            "name" => "required|max:255",
            "district_id" => "numeric|required"
        ];
    }
}
