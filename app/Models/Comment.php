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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
