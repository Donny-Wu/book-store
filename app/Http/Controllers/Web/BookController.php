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
use App\Models\BookMaker;
use App\Models\Author;

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
        $authors    = Author::get(['name','id']);
        $authors_id = [];

        return view('book.edit',compact(
        'languages',
       'publishers',
                  'authors',
                  'authors_id',
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
        $authors_id = $request->authors_id;
        $book       = Book::create($request->except('authors_id'));
        $book->authors()->sync($authors_id);
        // $response = $this->response(Response::HTTP_OK,'新增成功');
        // dd(route('book.edit', compact('book')));
        $response = [
            'icon'  => 'success',
            'title' => '新增成功',
            'text'  => '新增成功',
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
        $authors    = Author::get(['name','id']);
        $method     = 'PUT';
        $action     = route('book.update',compact('book'));
        $authors_id = $book->authors()->get()->pluck('id')->toArray();
        // dd($authors_id);
        return view('book.edit',compact(
         'languages',
        'publishers',
                   'authors',
                   'authors_id',
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
        // dd($request->authors_id);
        $authors_id = $request->authors_id;
        // dd($request->except('authors_id'));
        // dd($request->input());
        $book->update($request->except('authors_id'));
        $book->authors()->sync($authors_id);
        // $id = $book->id;
        // $response = $this->response(Response::HTTP_OK,'更新成功');
        $response = [
            'icon'  => 'success',
            'title' => '更新成功',
            'text'  => '更新成功',
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
