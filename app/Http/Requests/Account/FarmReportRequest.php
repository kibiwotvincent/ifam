<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use \Carbon\Carbon;

class FarmReportRequest extends FormRequest
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
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'department' => 'nullable|numeric',
            'categories' => 'nullable|array',
        ];
    }
	
	/**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->from != null && $this->to != null) {
				$from = new Carbon($this->from);
				$to = new Carbon($this->to);
				
				//extra validate `from` date only if `to` date exists
				//`from` date must be before or equals to `to` date
				if($from->gt($to)) {
					$validator->errors()->add(
						'from', "The from must be a date before or equal to to."
					);
				}
				
				//extra validate `to` date only if `from` date exists
				//`to` date must come after or equals to `from` date
				if($to->lt($from)) {
					$validator->errors()->add(
						'from', "The to must be a date after or equal to from."
					);
				}
			}
        });
		
		/*if($validator->fails()) {
			//get the first error message
			$errorMessage = $validator->errors()->all()[0];
			
			return response()
					->view('components.common.alert', ['type' => "danger", 'message' => $errorMessage], 200)
					->header('Content-Type', "text/html; charset=UTF-8");
		}*/
    }
}
