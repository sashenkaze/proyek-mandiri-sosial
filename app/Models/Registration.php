<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'activity_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
}
