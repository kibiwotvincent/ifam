<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AddSeasonRecordRequest extends FormRequest
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
            'title' => 'required',
            'summary' => 'required',
            'record_date' => 'required|date',
            'record_file_1' => 'sometimes|mimes:pdf,png,jpeg,jpg',
            'record_file_2' => 'sometimes|mimes:pdf,png,jpeg,jpg',
            'record_file_3' => 'sometimes|mimes:pdf,png,jpeg,jpg',
            'record_file_4' => 'sometimes|mimes:pdf,png,jpeg,jpg',
            'record_file_5' => 'sometimes|mimes:pdf,png,jpeg,jpg',
        ];
    }
}
