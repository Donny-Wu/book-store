<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;

use App\Models\Language;

class LanguageController extends Controller
{
    use HasApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $languages = Language::all();
        return $this->apiSuccess('資料顯示成功', $languages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $language = Language::create($request->all());
        return $this->apiCreated('資料新增成功', $language);
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        //
        return $this->apiSuccess('資料顯示成功', $language);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        //
        $language->update($request->all());
        return $this->apiSuccess('資料更新成功', $language);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        //
        $language->delete();
        return $this->apiSuccess('資料刪除成功');
    }
}
