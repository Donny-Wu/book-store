<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Traits\HasApiResponse;
use App\Http\Requests\AuthLoginRequest;

class AuthController extends Controller
{
    //
    use HasApiResponse;
    public function login(AuthLoginRequest $request){
        // dd($request->all());
        $user = User::where('email',$request->email)->first();
        if($user == null || $user instanceof User == false){
            return $this->apiUnauthorized('Email帳號未符合');
        }
        if(Hash::check($request->password,$user->password)){
            $expire_minutes = (int)env('SANCTUM_EXPIRE',null);
            $expires_at = Carbon::now()->addMinutes($expire_minutes);
            $token_name = env('SANCTUM_TOKEN','mytoken');
            $token = $user->createToken($token_name,['*'],$expires_at)->plainTextToken;
            // $token = $user->createToken('mytoken')->plainTextToken;
            return $this->apiSuccess('使用者登入成功',[
                'token'         => $token,
                'expires_at'    => $expires_at
            ]);
        }
        return $this->apiUnauthorized('使用者登入失敗');
    }
    public function logout(Request $request) {
        // dd(auth()->user(),$request->user());
        if(auth()->user() == null|| auth()->user() instanceof User == false){
            return $this->apiUnauthorized('身分未驗證');
        }
        auth()->user()->tokens()->delete();
        return $this->apiSuccess('登出成功');
    }
}
