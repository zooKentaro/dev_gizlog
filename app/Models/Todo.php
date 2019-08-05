<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $dates = [
        'reporting_time',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'contents',
        'reporting_time'
    ];

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }

}
