<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use softDeletes;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    public function fetchSearchQuestions($userId, $searchConditions)
    {
        return $this->where('user_id', $userId)
                    ->searchWord($searchConditions['search_word'])
                    ->searchTagCategory($searchConditions['tag_category_id'])
                    ->orderby('id', 'decs')
                    ->get();
    }

    public function scopeSearchTagCategory($query, $tagCategoryId)
    {
        if(!empty($tagCategoryId)) {
            return $this->where('tag_category_id', $tagCategoryId);
        }
    }

    public function scopeSearchWord($query, $searchWord)
    {
        if(!empty($searchWord)) {
            return $this->where('title', 'LIKE', "%$searchWord%");
        }
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
        return $this->hasMany('App\Models\Comment');
    }
}

