<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AccountRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'hourly_wage' => 'regex:/^\d*(\.\d{2})?$/',
            'description' => 'max:2000',
            'language_list' => 'exists:languages,id',
            'driver_license_list' => 'required|exists:driver_licenses,id',
        ];
    }
}
