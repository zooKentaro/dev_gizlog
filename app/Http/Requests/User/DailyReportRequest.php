<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
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
            'reporting_time'    => 'required',
            'title'             => 'required|max:200',
            'contents'          => 'required|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'reporting_time.required'   => '入力必須項目です。',
            'title.required'            => '入力必須項目です。',
            'title.max:200'             => '入力した文字が多すぎます。',
            'contents.required'         => '入力必須項目です。',
            'contents.max:200'          => '入力した文字が多すぎます。'
        ];
    }
}

