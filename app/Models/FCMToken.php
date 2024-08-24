<?php

namespace App\Models\TimeCatcher;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FCMToken extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'id',
        'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
