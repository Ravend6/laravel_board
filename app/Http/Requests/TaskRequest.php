<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TaskRequest extends Request
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
            'category_id' => 'required|exists:categories,id',
            // 'user_customer_id' => 'required|exists:users,id',
            'user_executant_id' => 'exists:users,id',
            'proposition_id' => 'exists:propositions,id',
            'title' => 'required|max:45|min:2',
            'description' => 'required|max:2000|min:2',
            'image' => 'image|max:1000',
            'price' => 'regex:/^\d*(\.\d{2})?$/',
            'date_begin' => 'required|date|datetime_compare_now',
            'date_end' => 'required|date|datetime_compare_now|datetime_compare:'.$this->date_begin,
        ];
        if (\Auth::guest()) {
            $rules['name'] = 'required|max:255';
            $rules['email'] = 'required|email|max:255|unique:users';
            $rules['phone'] = 'required|numeric';
            // unset($rules['user_customer_id']);
        }
        return $rules;
    }
}
