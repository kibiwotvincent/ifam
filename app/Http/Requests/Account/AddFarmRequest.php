<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AddFarmRequest extends FormRequest
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
            'owner' => 'required|string|max:11',
            'owner_id' => 'required|numeric',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'acreage' => 'nullable|numeric',
            'location' => 'nullable',
            'departments' => 'required|array',
        ];
    }
}
