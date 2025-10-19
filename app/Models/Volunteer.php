<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Volunteer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['domicile', 'interest', 'birth_date', 'profession', 'institute'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
