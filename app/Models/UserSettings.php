<?php

namespace App\Models;

class UserSettings extends BaseModel
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'language',
        'theme_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
