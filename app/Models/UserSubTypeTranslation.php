<?php

namespace App\Models;

class UserSubTypeTranslation extends BaseModel
{
    public $table = 'user_sub_types_translations';

    public $timestamps = false;

    public $fillable = [
        'name',
        'description',
        'locale'
    ];
}
