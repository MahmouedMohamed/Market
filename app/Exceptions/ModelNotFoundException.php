<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ModelNotFoundException extends Exception
{
    use ApiResponse;

    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        if (request()->segment(1) === 'api') {
            return $this->sendError('Resource Not Found');
        } else {
            return view(404);
        }
    }
}
