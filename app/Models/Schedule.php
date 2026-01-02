<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'date',
        'time',
        'status',
        'priority',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
