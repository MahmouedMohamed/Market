<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ability extends BaseModel
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'ability_role')->withTimestamps();
    }
}
