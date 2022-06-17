<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AddSaleRequest extends FormRequest
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
            'description' => 'nullable',
            'quantity' => 'required|numeric',
            'unit_measure' => 'required',
            'quality' => 'required',
            'expected_amount' => 'required|numeric',
            'sale_date' => 'required|date',
            'sale_receipt_copy' => 'nullable',
        ];
    }
	
}
