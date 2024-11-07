<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UploadChanelRequest;
use App\Interface\ChanelInterface;
use Illuminate\Support\Str;

class ChanelWorkController extends Controller
{
    //@dd(request()->session()->previousUrl(),$momo_action)
    private $service;
    public function __construct(ChanelInterface $service){
        $this->service = $service;
    }
    public function upload(UploadChanelRequest $request){
        // dd($request->file->getClientOriginalExtension(),Str::uuid()->toString());
        $extension = $request->file->getClientOriginalExtension();
        $path = $request->file->storeAs('chanels/'.$request->route('service'),Str::uuid()->toString().'.'.$extension);
        // 讀取 檔案/資料
        $this->service->fetchData();
        // 處理 資料邏輯
        $this->service->processData();
        // 寫入 資料庫
        $this->service->writeData();
        $response = [
                'icon'  => 'success',
                'title' => '訂單資料上傳成功',
                'text'  => '訂單資料上傳成功',
        ];
        return redirect()->back()->with('response', $response);
    }
    public function fetchAPI(){
        // // 讀取 檔案/資料
        // $this->service->fetchData();
        // // 處理 資料邏輯
        // $this->service->processData();
        // // 寫入 資料庫
        // $this->service->writeData();
    }
    public function fetchERP(){
        // // 讀取 檔案/資料
        // $this->service->fetchData();
        // // 處理 資料邏輯
        // $this->service->processData();
        // // 寫入 資料庫
        // $this->service->writeData();
    }
}
