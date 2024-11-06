<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interface\ChanelInterface;
use App\Enum\Chanel;
use Storage;

class ChanelOrderController extends Controller
{
    public function __construct(ChanelInterface $service){
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $momo_action  = route( 'chanel-order.upload',['service'=>Chanel::MOMO]);
        $elite_action = route( 'chanel-order.upload',['service'=>Chanel::ELITE]);
        // dd($action);
        return view('chanel_order.upload',compact(
            'momo_action',
            'elite_action'
        ));
    }
    public function upload(Request $request){
        // dd($request->url(),app()->request->route('service'));
        $path = $request->file->store('chanels/'.$request->route('service'));
        // dd($path);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Storage::put('test.jpg', $request->file('ImageFile')->get());
        dd($request->all());
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
