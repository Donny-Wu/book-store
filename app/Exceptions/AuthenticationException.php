<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\HasApiResponse;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;



class AuthenticationException extends Exception
{
    use HasApiResponse;
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
    public function render(Request $request)
    {
        // dd(PersonalAccessToken::findToken($request->bearerToken())->expires_at);
        // dd($request->bearerToken());
        $token = PersonalAccessToken::findToken($request->bearerToken());
        if($token!==null&&$token->expires_at <= Carbon::now()) {
            return $this->apiResponse(Response::HTTP_UNAUTHORIZED,'使用者身分已過期:token expired');
        }
        return $this->apiResponse(Response::HTTP_UNAUTHORIZED,'使用者身分未驗證:Unauthenticated');
    }
}
