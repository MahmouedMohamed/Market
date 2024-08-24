<?php

namespace App\Models;

use App\ConverterModels\Gender;
use App\ConverterModels\UserStatus;
use App\Models\TimeCatcher\FCMToken;
use Carbon\Carbon;

class User extends BaseUserModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'type_id',
        'sub_type_id',
        'nationality_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function type()
    {
        return $this->belongsTo(UserType::class, 'id', 'type_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimeStamps();
    }

    public function assignRole($role)
    {
        $this->roles()->sync($role);  //save if not there, replace if there // can pass argument(x,false) //false will let us add without dropping anything
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

    public function hasAbility(string $ability)
    {
        return $this->abilities($ability);
    }

    public function fcmTokens()
    {
        return $this->hasOne(FCMToken::class);
    }

    public function settings()
    {
        return $this->hasOne(UserSettings::class);
    }

    public function accessTokens()
    {
        return $this->hasMany(OauthAccessToken::class, 'owner_id');
    }

    public function sellerCustomFields()
    {
        if ($this->type == 'Seller') {
            return $this->hasOne(SellerCustomFields::class, 'user_id', 'id');
        }
        return null;
    }

    public function createAccessToken($accessType)
    {
        $this->deleteRelatedAccessTokens($accessType);
        $expiryDate = Carbon::now()->addMonth()->startOfDay();
        $accessToken = $this->accessTokens()->create([
            'user_id' => $this->id,
            'access_type' => $accessType,
            'active' => 1,
            'expires_at' => $expiryDate,
        ]);

        $key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

        $encryptedData['token_id'] = $accessToken->id;
        $encryptedData['user_id'] = $this->id;
        $encryptedData['access_type'] = $accessType;
        $encryptedData['expiryDate'] = $expiryDate;

        $cipherText = sodium_crypto_secretbox(json_encode($encryptedData), $nonce, $key);
        $accessToken = sodium_bin2base64($cipherText, 5) . '.' . sodium_bin2base64($nonce, 5) . '.' . sodium_bin2base64($key, 5);

        return ['accessToken' => $accessToken, 'expiryDate' => $expiryDate];
    }

    public function deleteRelatedAccessTokens($accessType)
    {
        $this->accessTokens()->where('access_type', '=', $accessType)->update(['active' => false]);
    }


    public function setGenderAttribute($text)
    {
        $this->attributes['gender'] = Gender::$value[$text];
    }

    public function getGenderAttribute($value)
    {
        $source = app()->getLocale() === 'ar' ? 'text_ar' : 'text';
        if ($value) {
            return Gender::$$source[$value];
        }

        return null;
    }

    public function getStatus($value)
    {
        return UserStatus::$text[$value];
    }
}
