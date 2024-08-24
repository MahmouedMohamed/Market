<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class OauthAccessToken extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'owner_id',
        'owner_type',
        'app_type',
        'access_type',
        'active',
        'expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'access_token',
    ];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function refreshToken($accessType, $appType)
    {
        return $this->user->createAccessToken($accessType, $appType);
    }
}
