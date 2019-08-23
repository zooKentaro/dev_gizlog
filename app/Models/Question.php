<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    public function fetchAllQusestions($userId)
    {
        return $this->where('user_id', $userId)
                    ->join('users', 'user_id', '=', 'users.id')
                    ->join('tag_categories', 'tag_category_id', '=', 'tag_categories.id')
                    ->get();
    }

    public function fetchSearchQuestions($userId, $searchWord)
    {

    }
}

