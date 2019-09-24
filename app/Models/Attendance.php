<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Attendance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'start_time',
        'end_time',
        'user_id',
        'modification_flg',
        'modification_reason',
        'absence_reason',
        'registration_date',
    ];

    protected $dates =[
        'start_time',
        'end_time',
    ];

    public function todaysRecord($id)
    {
        return $this->where('user_id', $id)
            ->where('registration_date', Carbon::today()->format('Y-m-d'))
            ->orderBy('id', 'desc')
            ->first();
    }

    public function scopeExistingStartTime()
    {
        //
    }

    public function scopeExistingEndTime()
    {
        //
    }

    public function user()
    {
        return $this->belongsTo('App\Models\user');
    }
}
