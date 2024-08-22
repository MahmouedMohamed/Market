<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

class UserType extends BaseModel
{
    use Translatable;

    public $table = 'user_types';

    public $translationModel = UserTypeTranslation::class;

    public $translatedAttributes = [
        'name',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subTypes()
    {
        return $this->hasMany(WishListItem::class);
    }
}
