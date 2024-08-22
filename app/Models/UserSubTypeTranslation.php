<?php

namespace App\Models;

class UserSubTypeTranslation extends BaseModel
{
    const USE_UUID = false;

    public $incrementing = true;

    public $table = 'user_sub_types_translations';

    public $timestamps = false;

    public $fillable = [
        'name',
        'description',
        'locale'
    ];
}
