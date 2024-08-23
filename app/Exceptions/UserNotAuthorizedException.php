<?php

namespace App\Exceptions;

use App\Models\User;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserNotAuthorizedException extends Exception
{
    use ApiResponse;

    /**
     * Report the exception.
     *
     *
     *
     * @return bool|null
     */
    public function report()
    {
        return $this->sendError(__('User Not Authorized'), [], 403);
    }
}
