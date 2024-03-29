<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailService extends FormRequest
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
            'render_date' => 'required|date',
            'delivery_address' => 'required|string|max:500',
            'message' => 'required|string|max:1000'
        ];
    }
}
