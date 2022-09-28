<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
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
            'sale_id' => 'required|numeric',
			'description' => 'nullable',
            'quantity' => 'required|numeric',
            'unit_measure' => 'required',
            'quality' => 'nullable',
            'expected_amount' => 'nullable|numeric',
            'sale_date' => 'required|date',
			'sale_receipt_copy' => 'nullable|mimes:pdf,png,jpeg,jpg',
			'amount_paid' => 'nullable|numeric',
            'payment_date' => 'nullable|date',
			'payment_receipt_copy' => 'nullable|mimes:pdf,png,jpeg,jpg',
			'payment_info' => 'nullable',
			
        ];
    }
	
}
