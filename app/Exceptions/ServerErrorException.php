<?php

namespace App\Exceptions;
use Illuminate\Http\Response;

use Exception;

class ServerErrorException extends Exception
{
    public function __construct($message = "Server error", $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        parent::__construct($message, $code);
    }
}
