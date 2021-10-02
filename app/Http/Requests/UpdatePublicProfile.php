<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePublicProfile extends FormRequest
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
            'daily_income' => 'nullable|integer',
            'daily_expenses' => 'nullable|integer',
            'kids.*.name' => 'nullable|string|max:50',
            'kids.*.age' => 'required_with:kids.*.name|nullable|integer',
            'dependents.*.name' => 'nullable|string|max:50',
            'dependents.*.age' => 'required_with:dependents.*.name|nullable|integer',
            'skills.*.name' => 'nullable|string|max:50',
            'workexp.*.company' => 'nullable|string|max:50',
            'workexp.*.description' => 'nullable|string|max:50',
            'workexp.*.year' => 'nullable|string|max:9',
            'bio' => 'nullable|string|max:1000'
        ];
    }
}
