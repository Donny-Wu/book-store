<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function create(){
        return view('order.checkout');
    }
    public function store(Request $request){
        dd($request->all());
    }
}
