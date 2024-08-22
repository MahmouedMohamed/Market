<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class NationalityTranslation extends BaseModel
{
    use HasFactory;

    public $table = 'nationality_translations';

    public $timestamps = false;

    public $fillable = [
        'name',
        'description',
        'locale'
    ];
}
