<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;
use App\Models\Publisher;

class PublisherController extends Controller
{
    use HasApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $publishers = Publisher::all();
        return $this->apiSuccess('資料顯示成功', $publishers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $publisher = Publisher::create($request->all());
        return $this->apiCreated('資料新增成功', $publisher);
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
        return $this->apiSuccess('資料顯示成功', $publisher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        //
        $publisher->update($request->all());
        return $this->apiSuccess('資料更新成功', $publisher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        //
        $publisher->delete();
        return $this->apiSuccess('資料刪除成功');
    }
}
