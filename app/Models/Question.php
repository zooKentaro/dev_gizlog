<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    public function fetchAllQusestions($userId)
    {
        return $this->where('user_id', $userId)->get();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tagCategory()
    {
        return $this->belongsTo('App\Models\TagCategory');
    }

    public function comment()
    {
        return $this->belongsTo('App\Models\Comment');
    }
}

