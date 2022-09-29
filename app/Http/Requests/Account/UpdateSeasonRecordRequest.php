<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeasonRecordRequest extends FormRequest
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
            'season_record_id' => 'required|numeric',
            'title' => 'required',
            'summary' => 'required',
            'record_date' => 'required|date|before_or_equal:today',
            'record_file_1' => 'nullable|mimes:pdf,png,jpeg,jpg',
            'record_file_2' => 'nullable|mimes:pdf,png,jpeg,jpg',
            'record_file_3' => 'nullable|mimes:pdf,png,jpeg,jpg',
            'record_file_4' => 'nullable|mimes:pdf,png,jpeg,jpg',
            'record_file_5' => 'nullable|mimes:pdf,png,jpeg,jpg',
        ];
    }
}
