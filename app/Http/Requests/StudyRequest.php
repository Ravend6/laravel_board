<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudyRequest extends Request
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
            'institution' => 'required|max:45',
            'specialization' => 'required|max:45',
            'description' => 'max:1000',
            'from' => 'required|date',
            'to' => 'required|date|date_compare:'.$this->from,
        ];

        if ($this->is_present) {
            unset($rules['to']);
        }

        return $rules;
    }
}
