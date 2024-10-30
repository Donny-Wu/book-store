<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\HasApiResponse;

class NotFoundHttpException extends Exception
{

    use HasApiResponse;
        /**
     * Report the exception.
     */
    public function report(): void
    {
        // ...
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return $this->apiResponse(Response::HTTP_NOT_FOUND,'資源未找到');
    }

}
