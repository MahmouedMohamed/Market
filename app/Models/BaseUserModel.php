<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class BaseUserModel extends AuthenticatableUser
{
    use HasFactory, Notifiable;

    public $incrementing = false;
}
