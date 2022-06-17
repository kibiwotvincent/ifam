<?php

namespace App\Http\Requests\Account\Group;

use Illuminate\Foundation\Http\FormRequest;

class AddGroupMemberRequest extends FormRequest
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
            'id_number' => 'required|numeric|digits_between:7,8',
        ];
    }
}
