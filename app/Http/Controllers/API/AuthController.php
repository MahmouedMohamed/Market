<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\AuthService;
use App\Traits\ApiResponse;

class AuthController extends BaseController
{
    use ApiResponse;
    public function __construct(private AuthService $authService) {}

    public function register(RegisterRequest $registerRequest)
    {
        $details = $this->authService->register($registerRequest);

        return $this->sendResponse($details, __('General.User Created Successfully'));
    }
}
