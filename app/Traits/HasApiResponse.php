<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\HasDataResponse;
trait HasApiResponse{
    use HasDataResponse;
    public function apiResponse(...$args)
    {
        // dd($this->response(...$args));
        return response()->json($this->response(...$args),$args[0]);
    }
    public function apiError($message = '',$data = []){
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        return $this->apiResponse($code,$message,$data);
    }
    public function apiSuccess($message = '',$data = []){
        $code = Response::HTTP_OK;
        return $this->apiResponse($code,$message,$data);
    }
    public function apiUnauthorized($message = '',$data = []){
        $code = Response::HTTP_UNAUTHORIZED;
        return $this->apiResponse($code,$message,$data);
    }
    public function apiCreated($message = '',$data = []){
        $code = Response::HTTP_CREATED;
        return $this->apiResponse($code,$message,$data);
    }
}
