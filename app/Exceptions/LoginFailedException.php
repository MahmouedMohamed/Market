<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;

class LoginFailedException extends Exception
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
        return $this->sendError(__('The email or password is incorrect.'), [], 400);
    }
}
