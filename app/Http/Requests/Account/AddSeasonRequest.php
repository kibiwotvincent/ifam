<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AddSeasonRequest extends FormRequest
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
            'department_id' => 'required|numeric',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'start_date' => 'required|date',
            'child_category_id' => 'nullable|numeric',
            'child_sub_category_id' => 'nullable|numeric',
            'metadata' => 'sometimes|array',
        ];
    }
	
	/**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
   /* public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->somethingElseIsInvalid()) {
                $validator->errors()->add('field', 'Something is wrong with this field!');
            }
        });
    }
	
	/**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    /*public function attributes()
    {
        return [
            'metadata.crop_id' => 'crop',
            'metadata.variety_id' => 'variety',
        ];
    }*/
}
