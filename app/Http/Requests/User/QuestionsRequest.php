<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
            'tag_category_id' => 'sometimes|required_with:title,content|in:0,1,2,3,4,""',
            'title'           => 'sometimes|required|max:30',
            'content'         => 'sometimes|required|max:1000',
            'search_word'     => 'sometimes|max:50'
        ];
    }

    public function messages()
    {
        return [
            'tag_category_id.required'  => 'タグを選択してください。',
            'tag_category_id.in'        => 'リストの中からタグを選択してください。',
            'title.required'            => '入力必須項目です。',
            'title.max'                 => '30文字以内で入力してください。',
            'content.required'          => '入力必須項目です。',
            'content.max'               => '1000文字以内で入力してください。',
            'search_word.max'           => '検索文字は50文字以内にしてください。',
        ];
    }
}

