<?php

namespace App\Http\Controllers\Web;

use App\Models\ChanelOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interface\ChanelInterface;
use App\Enum\Chanel;
use Storage;

class ChanelOrderController extends Controller
{
    public function __construct(){
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $chanel_orders = ChanelOrder::with(['chanel_company'])->orderBy('id','desc')->paginate();
        return view('chanel_order.index',compact('chanel_orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $momo_action  = route( 'chanel-work.upload',['service'=>Chanel::MOMO]);
        $elite_action = route( 'chanel-work.upload',['service'=>Chanel::ELITE]);
        // dd($action);
        return view('chanel_order.upload',compact(
             'momo_action',
            'elite_action'
        ));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Storage::put('test.jpg', $request->file('ImageFile')->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
