<?php

namespace App\Http\Requests\Account\Group;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Account\Contribution;

class AddContributionRequest extends FormRequest
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
            'group_member_id' => 'required|numeric',
            'target_year' => 'required|numeric',
            'target_month' => 'required|numeric',
			'amount' => 'required|numeric|min:'.Contribution::MINIMUM_AMOUNT,
            'date_received' => 'required|date',
            'payment_mode' => 'required|string',
            'transaction_info' => 'nullable',
        ];
    }
	
}
