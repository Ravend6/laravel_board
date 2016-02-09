<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class DriverLicenseRequest extends Request
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
        $rules = [
            'title' => 'required|max:45|unique:driver_licenses',
        ];

        if ($this->isMethod('patch')) {
            $rules['title'] = 'required|max:45|unique:driver_licenses,title,'.
                $this->route('driver_licenses');
        }

        return $rules;
    }
}
