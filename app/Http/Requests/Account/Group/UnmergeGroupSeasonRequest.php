<?php

namespace App\Http\Requests\Account\Group;

use Illuminate\Foundation\Http\FormRequest;

class UnmergeGroupSeasonRequest extends FormRequest
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
            'group_id' => 'required|numeric',
            'group_member_id' => 'required|numeric',
            'season_id' => 'required|numeric',
        ];
    }
}
