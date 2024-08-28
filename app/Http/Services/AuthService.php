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
    public function login(LoginRequest $request)
    {
        try {
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
                /** @var User $user  */
                $user = Auth::user();
                $tokenDetails = $user->createAccessToken($request['accessType']);

                return [
                    'token' => $tokenDetails['accessToken'],
                    'expiryDate' => $tokenDetails['expiryDate'],
                    'user' => new UserResource($user, $user->type_id),
                    'profile' => ProfileResource::make($user->profile),
                ];
            } else {
                throw new LoginFailedException();
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

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
            'gender' => $registerRequest->input('gender')
        ]);
        if ($registerRequest->type_id == 3) {
            $user->sellerCustomFields()->create([
                'shop_name' => $registerRequest->input('shop_name'),
                'shop_address' => $registerRequest->input('shop_address'),
                'shop_latitude' => $registerRequest->input('shop_latitude'),
                'shop_longitude' => $registerRequest->input('shop_longitude'),
            ]);
        }
        if ($registerRequest->type_id == 2 && $registerRequest->sub_type_id == 1) {
            $user->studentCustomFields()->create([
                'university' => $registerRequest->input('university'),
                'student_number' => $registerRequest->input('student_number'),
            ]);
        }
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
