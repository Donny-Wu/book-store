<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UploadChanelRequest;

class ChanelWorkController extends Controller
{
    //@dd(request()->session()->previousUrl(),$momo_action)
    public function __construct(){}
    public function upload(UploadChanelRequest $request){
        $path = $request->file->store('chanels/'.$request->route('service'));
    }
}