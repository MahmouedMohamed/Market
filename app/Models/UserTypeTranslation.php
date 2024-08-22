<?php

namespace App\Models;

class UserTypeTranslation extends BaseModel
{
    const USE_UUID = false;

    public $incrementing = true;

    public $table = 'user_types_translations';

    public $timestamps = false;

    public $fillable = [
        'name',
        'description',
        'locale'
    ];
}
