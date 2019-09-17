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
    ];

    public function todaysRecord($id)
    {
        return $this->where('user_id', $id)
            ->whereDate('start_time', Carbon::today()->format('Y-m-d'))
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
}
