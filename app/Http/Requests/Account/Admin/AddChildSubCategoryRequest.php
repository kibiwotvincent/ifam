<?php

namespace App\Http\Requests\Account\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddChildSubCategoryRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'nullable',
            'parent_category_id' => 'required|numeric',
        ];
    }
}
