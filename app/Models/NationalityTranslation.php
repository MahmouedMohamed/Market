<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class NationalityTranslation extends BaseModel
{
    use HasFactory;

    const USE_UUID = false;

    public $incrementing = true;

    public $table = 'nationality_translations';

    public $timestamps = false;

    public $fillable = [
        'name',
        'description',
        'locale'
    ];
}
