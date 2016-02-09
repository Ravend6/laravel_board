<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PropositionRequest extends Request
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
            'task_id' => 'required|exists:tasks,id',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'description' => 'required|max:2000|min:2',
        ];
    }
}
