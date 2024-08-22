<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

class UserSubType extends BaseModel
{
    use Translatable;

    public $table = 'user_sub_types';

    public $translationModel = UserSubTypeTranslation::class;

    public $translatedAttributes = [
        'name',
        'description',
    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
}
