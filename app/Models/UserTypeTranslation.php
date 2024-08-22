<?php

namespace App\Models;

class UserTypeTranslation extends BaseModel
{
    public $table = 'user_types_translations';

    public $timestamps = false;

    public $fillable = [
        'name',
        'description',
        'locale'
    ];
}
