<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\HasApiResponse;

class AccessDeniedHttpException extends Exception
{
    //
    use HasApiResponse;
    public function report(): void
    {
        // ...
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return $this->apiResponse(Response::HTTP_FORBIDDEN,'使用者操作未被授權');
    }
}
