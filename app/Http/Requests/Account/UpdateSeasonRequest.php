<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeasonRequest extends FormRequest
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
            'season_id' => 'required|numeric',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'child_sub_category_id' => 'nullable|numeric',
            'acreage' => 'nullable|numeric',
            'status' => 'nullable|alpha',
            'merged_group_id' => 'nullable|numeric',
        ];
    }

}
