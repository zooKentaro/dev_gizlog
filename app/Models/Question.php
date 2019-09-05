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

    public function fetchSearchQuestions($searchWord, $searchTag)
    {
        return $this->with(['user', 'tagCategory', 'comment'])
                    ->searchWord($searchWord)
                    ->searchTagCategory($searchTag)
                    ->orderby('id', 'desc')
                    ->get();
    }

    public function scopeSearchTagCategory($query, $tagCategoryId)
    {
        if (!empty($tagCategoryId)) {
            return $query->where('tag_category_id', $tagCategoryId);
        }
    }

    public function scopeSearchWord($query, $searchWord)
    {
        if (!empty($searchWord)) {
            return $query->where('title', 'LIKE', "%$searchWord%");
        }
    }

}

