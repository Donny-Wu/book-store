@extends('layouts.main')
@vite(['resources/css/input.css'])
@section('content')
<div class="w-full min-h-screen bg-gray-100">
    <div class="w-full mt-8">
        <ul class="flex justify-center items-center">
            <li><a href="" class="btn btn-focus">回首頁</a></li>
            <li><a href="" class="px-8 py-4 bg-blue-500 text-white rounded-md mr-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white hover:bg-blue-600 duration-300">留言按鈕</a></li>
        </ul>

    </div>
    <div class="w-[800px] mx-auto">
        <h1 class="block text-2xl font-bold py-8">寫一個留言版型</h1>
        <div class="w-full flex justify-center items-center">
            <img class="w-14 h-14 mr-4 rounded-full" src="https://picsum.photos/50/50" alt="">
            <input class="w-[600px] p-4 rounded-md mr-3"type="text" name="" id="" placeholder="請輸入留言">
            <button class="px-10 py-4 bg-blue-500 text-white rounded-md">發佈</button>
        </div>
    </div>
</div>
@endsection
