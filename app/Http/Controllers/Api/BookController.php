<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    use HasApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::all();
        return $this->apiSuccess('success',$books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $book = Book::create($request->all());
        return $this->apiCreated('資料新增成功', $book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
        return $this->apiSuccess('資料顯示成功', $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Book $book)
    {
        //
        $book->update($request->all());
        return $this->apiSuccess('資料更新成功', $book);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return $this->apiSuccess('資料刪除成功');
    }
}
