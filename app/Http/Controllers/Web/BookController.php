<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Traits\HasDataResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Book;
use App\Models\Language;
use App\Models\Publisher;

class BookController extends Controller
{
    use HasDataResponse;

    public function products(){
        $books = Book::with(['publisher','language'])->get();
        return view('book.products',compact('books'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::with(['publisher','language'])->orderBy('id','desc')->paginate();
        return view('book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd(Language::all());
        // value="{{ old('username') }}"
        $languages  = Language::all();
        $publishers = Publisher::all();
        $method     = 'POST';
        $action     = route('book.store');

        return view('book.edit',compact(
        'languages',
        'publishers',
                    'method',
                    'action'
        ));
        //
        // dd('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        //
        // dd($request->all());
        $book = Book::create($request->all())->id;
        // $response = $this->response(Response::HTTP_OK,'新增成功');
        // dd(route('book.edit', compact('book')));
        $response = [
            'icon' => 'success',
            'title' => '新增成功',
            'text' => '新增成功',
        ];
        return redirect(route('book.edit', compact('book')))->with(compact(
            'response'
        ));
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
    public function edit(Book $book)
    {
        //
        $languages  = Language::all();
        $publishers = Publisher::all();
        $method     = 'PUT';
        $action     = route('book.update',compact('book'));

        return view('book.edit',compact(
        'languages',
        'publishers',
                    'method',
                    'action',
                    'book'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBookRequest $request, Book $book)
    {
        //
        $book->update($request->all());
        // $id = $book->id;
        // $response = $this->response(Response::HTTP_OK,'更新成功');
        $response = [
            'icon' => 'success',
            'title' => '更新成功',
            'text' => '更新成功',
        ];

        return redirect(route('book.edit', compact('book')))->with(compact(
            'response'
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
