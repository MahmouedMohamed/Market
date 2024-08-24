<?php

namespace App\Models;

class UserSettings extends BaseModel
{
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
