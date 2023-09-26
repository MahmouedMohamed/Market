<?php

namespace App\Traits;

trait ApiResponse
{
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'err_flag' => false,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'err_flag' => true,
            'err_desc' => $error,
        ];

        if (! empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function sendForbidden($message)
    {
        $response = [
            'err_flag' => true,
            'err_desc' => $message,
        ];

        return response()->json($response, 403);
    }
}
