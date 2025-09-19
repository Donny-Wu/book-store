<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    //
    public function index(){
        // dd(Book::all());
        return view('index',['books'=>Book::all()]);
    }
    public function home(){
        return view('home',['books'=>Book::all()]);
    }
}
