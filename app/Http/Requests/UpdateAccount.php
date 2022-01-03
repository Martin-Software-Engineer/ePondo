<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccount extends FormRequest
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
            // 'firstname' => 'required|string|max:50',
            // 'lastname' => 'required|string|max:50',
            'phone' => 'nullable|string|max:12',
            'address' => 'nullable|string|max:100',
            'zipcode'   => 'nullable|integer'
        ];
    }
}
