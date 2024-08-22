<?php

namespace App\Models;

class UserTypeTranslation extends BaseModel
{
    public $table = 'user_types_translations';

    public $fillable = [
        'name',
        'description',
        'locale'
    ];
}
