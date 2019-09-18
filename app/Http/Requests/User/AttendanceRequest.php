<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class AttendanceRequest extends FormRequest
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
            'request_content'       => 'sometimes|required|max:200',
            'absent_reason'         => 'sometimes|required|max:200',
            'date'                  => 'sometimes|required',
            'absence_reason'        => 'sometimes|required|max:500',
            'request_day'           => "sometimes|required|before_or_equal:today",
            'modification_reason'   => 'sometimes|required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'request_content.required'      => '入力必須の項目です',
            'request_content.max'           => '200文字以内で入力してください。',
            'absent_reason.required'        => '入力必須の項目です',
            'absent_reason.max'             => '200文字以内で入力してください。',
            'date.required'                 => '入力必須の項目です',
            'absence_reason.required'       => '入力必須の項目です',
            'absence_reason.max'            => '500文字以内で入力してください。',
            'request_day.required'          => '入力必須の項目です',
            'request_day.before_or_equal'            => '今日以前の日付を入力してください。',
            'modification_reason.required'  => '入力必須の項目です',
            'modification_reason.max'       => '500文字以内で入力してください。',
        ];
    }
}
