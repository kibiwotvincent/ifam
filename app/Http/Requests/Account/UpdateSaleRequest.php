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
			'description' => 'required',
            'quantity' => 'required|numeric',
            'unit_measure' => 'required',
            'quality' => 'nullable',
            'expected_amount' => 'nullable|numeric',
            'sale_date' => 'required|date|before_or_equal:today',
			'sale_receipt_copy' => 'nullable|mimes:pdf,png,jpeg,jpg',
			'amount_paid' => 'nullable|required_with:payment_date,payment_receipt_copy|numeric',
            'payment_date' => 'nullable|required_with:amount_paid,payment_receipt_copy|date|after_or_equal:sale_date',
			'payment_receipt_copy' => 'nullable|mimes:pdf,png,jpeg,jpg',
			'payment_info' => 'nullable',
			
        ];
    }
	
}
