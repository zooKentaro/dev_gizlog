<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'user_id',
        'question_id',
        'question_user_id',
    ];

    public function getComment($id)
    {
        return $this->where('question_id', $id)
                    ->orderby('id', 'desc')
                    ->get();
    }
}