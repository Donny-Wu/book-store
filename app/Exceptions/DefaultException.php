<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response;

class DefaultException extends Exception
{
    //
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
    public function render(Request $request): Response
    {
        // return response()->json(['error'=>'資源未找到'],Response::HTTP_NOT_FOUND);

        return response(['error'=>$this->getMessage()],Response::HTTP_INTERNAL_SERVER_ERROR);
        // return response(/* ... */);
    }
}
