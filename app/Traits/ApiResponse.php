<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    public function success($message = 'Request Successful', $data = [], $code = Response::HTTP_OK)
    {
        return response()->json([
            'success'=> true,
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function error($message = 'Server Error', $code = Response::HTTP_INTERNAL_SERVER_ERROR, $errors = [],)
    {
        return response()->json([
            'success'=> false,
            'status' => $code,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
