<?php

namespace App\Http\Services;

use App\Exceptions\LoginFailedException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(RegisterRequest $registerRequest)
    {
        DB::beginTransaction();
        $user = User::create([
            'name' => $registerRequest->input('name'),
            'user_name' => $registerRequest->input('user_name'),
            'email' => $registerRequest->input('email'),
            'gender' => $registerRequest->input('gender'),
            'password' => Hash::make($registerRequest->input('password')),
            'phone_number' => $registerRequest->input('phone_number'),
            'nationality_id' => $registerRequest->input('nationality_id'),
            'type_id' => $registerRequest->input('type_id'),
            'sub_type_id' => $registerRequest->input('sub_type_id'),
            'status' => 1,
        ]);
        $profile = $user->profile()->create([]);
        $user->settings()->create([
            'language' => app()->getLocale(),
            'theme_id' => $registerRequest->input('theme_id'),
        ]);
        $image = $registerRequest->input('image');
        if ($image != null) {
            $imagePath = $image->store('users', 'public');
            $profile->image = '/storage/' . $imagePath;
            $profile->save();
        }

        DB::commit();

        return UserResource::make($user);
    }
}
