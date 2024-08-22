<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

class Nationality extends BaseModel
{
    use Translatable;

    const USE_UUID = false;

    public $incrementing = true;

    public $table = 'nationalities';

    public $translationModel = NationalityTranslation::class;

    public $timestamps = false;

    public $translatedAttributes = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
