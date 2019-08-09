<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $dates = [
        'reporting_time',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'contents',
        'reporting_time',
        'deleted_at'
    ];

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)
                    ->where('deleted_at', 'NULL')
                    ->get();
    }

    public function getSearchReports($dt)
    {
        return $this->whereYear('reporting_time', $dt->year)
                    ->whereMonth('reporting_time', $dt->month)
                    ->where('deleted_at', 'NULL')
                    ->get();
    }
}
