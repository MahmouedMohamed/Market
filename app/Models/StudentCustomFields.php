<?php

namespace App\Models;

class StudentCustomFields extends BaseModel
{
    const USE_UUID = false;

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'university',
        'student_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
