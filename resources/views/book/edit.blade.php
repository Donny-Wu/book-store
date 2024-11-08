@extends('layouts.dashboard')
@section('content')
<div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8 my-4">
    <form class="" action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(in_array(strtoupper($method), ['PUT', 'PATCH']))
            @method(strtoupper($method))
        @endif
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">書籍基本資料</h2>
                <p class="mt-1 text-sm/6 text-gray-600">
                </p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">
                            書名
                        </label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                {{-- <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span> --}}
                                <input type="text" name="title" id="" autocomplete="" value="{{ $book->title??old('title','') }}"class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" placeholder="書籍名稱">
                            </div>
                            @if($errors->has('title'))
                                <span style="font-size:1rem;font-weight:bold;color:red;margin-bottom:5rem;">{{ $errors->get('title')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="" class="block text-sm/6 font-medium text-gray-900">作者</label>
                        <div class="mt-2">
                            <x-multiple-select name="authors_id" :options="$authors" :values="(!empty($authors_id))?$authors_id:old('authors_id',[])" />
                            @if($errors->has('authors_id'))
                                <span style="font-size:1rem;font-weight:bold;color:red;margin-bottom:5rem;">{{ $errors->get('authors_id')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">
                            ISBN
                        </label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                {{-- <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span> --}}
                                <input type="text" name="isbn" id="" autocomplete="" value="{{ $book->isbn??old('isbn','') }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" placeholder="ISBN(10碼)">
                            </div>
                            @if($errors->has('isbn'))
                                <span style="font-size:1rem;font-weight:bold;color:red;margin-bottom:5rem;">{{ $errors->get('isbn')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">
                            ISBN-13
                        </label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="isbn_13" id="" autocomplete="" value="{{ $book->isbn_13??old('isbn_13','') }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" placeholder="ISBN(13碼)">
                            </div>
                            @if($errors->has('isbn_13'))
                                <span style="font-size:1rem;font-weight:bold;color:red;margin-bottom:5rem;">{{ $errors->get('isbn_13')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">
                           出版日期
                        </label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="date" name="published_at" id="" autocomplete="" value="{{ $book->published_at??old('published_at','') }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" placeholder="出版日期">
                            </div>
                            @if($errors->has('published_at'))
                                <span style="font-size:1rem;font-weight:bold;color:red;margin-bottom:5rem;">{{ $errors->get('published_at')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="" class="block text-sm/6 font-medium text-gray-900">出版商</label>
                        <div class="mt-2">
                            <select id="" name="publisher_id" autocomplete="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                @foreach($publishers as $row)
                                    <option value="{{ $row->id }}" @selected((isset($book->publisher_id)&&$row->id == $book->publisher_id)||old('publisher_id')==$row->id)>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('publisher_id'))
                                <span style="font-size:1rem;font-weight:bold;color:red;margin-bottom:5rem;">{{ $errors->get('publisher_id')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="" class="block text-sm/6 font-medium text-gray-900">語言</label>
                        <div class="mt-2">
                            <select id="" name="language_id" autocomplete="" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                                @foreach($languages as $row)
                                    <option value="{{ $row->id }}" @selected((isset($book->language_id)&&$row->id == $book->language_id)||old('language_id')==$row->id)>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('language_id'))
                                <span style="font-size:1rem;font-weight:bold;color:red;margin-bottom:5rem;">{{ $errors->get('language_id')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">
                            定價
                        </label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                {{-- <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span> --}}
                                <input type="number" name="price" id="" value="{{ $book->price??old('price',0.0) }}" autocomplete="" step="0.1" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm/6" placeholder="價格">
                            </div>
                            @if($errors->has('price'))
                                <span style="font-size:1rem;font-weight:bold;color:red;margin-bottom:5rem;">{{ $errors->get('price')[0] }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-full">
                        <label for="about" class="block text-sm/6 font-medium text-gray-900">內容描述</label>
                        <div class="mt-2">
                            <textarea id="about" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                {{ $book->description??old('description','') }}
                            </textarea>
                            @if($errors->has('description'))
                                <span style="font-size:1rem;font-weight:bold;color:red;margin-bottom:5rem;">{{ $errors->get('description')[0] }}</span>
                            @endif
                        </div>
                        <p class="mt-3 text-sm/6 text-gray-600">內容描述.</p>
                    </div>

                    {{-- <div class="col-span-full">
                        <label for="photo" class="block text-sm/6 font-medium text-gray-900">Photo</label>
                        <div class="mt-2 flex items-center gap-x-3">
                        <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>
                        <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button>
                        </div>
                    </div> --}}

                    {{-- <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Cover photo</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                            </svg>
                            <div class="mt-4 flex text-sm/6 text-gray-600">
                            <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                <span>Upload a file</span>
                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                        </div>
                    </div> --}}
                </div>
            </div>

            {{-- <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Use a permanent address where you can receive mail.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="first-name" class="block text-sm/6 font-medium text-gray-900">First name</label>
                    <div class="mt-2">
                    <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Last name</label>
                    <div class="mt-2">
                    <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="country" class="block text-sm/6 font-medium text-gray-900">Country</label>
                    <div class="mt-2">
                    <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                        <option>United States</option>
                        <option>Canada</option>
                        <option>Mexico</option>
                    </select>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="street-address" class="block text-sm/6 font-medium text-gray-900">Street address</label>
                    <div class="mt-2">
                    <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="city" class="block text-sm/6 font-medium text-gray-900">City</label>
                    <div class="mt-2">
                    <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="region" class="block text-sm/6 font-medium text-gray-900">State / Province</label>
                    <div class="mt-2">
                    <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="postal-code" class="block text-sm/6 font-medium text-gray-900">ZIP / Postal code</label>
                    <div class="mt-2">
                    <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                    </div>
                </div>
                </div>
            </div> --}}

            {{-- <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Notifications</h2>
                <p class="mt-1 text-sm/6 text-gray-600">We'll always let you know about important changes, but you pick what else you want to hear about.</p>

                <div class="mt-10 space-y-10">
                <fieldset>
                    <legend class="text-sm/6 font-semibold text-gray-900">By Email</legend>
                    <div class="mt-6 space-y-6">
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                        <input id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm/6">
                        <label for="comments" class="font-medium text-gray-900">Comments</label>
                        <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                        </div>
                    </div>
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                        <input id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm/6">
                        <label for="candidates" class="font-medium text-gray-900">Candidates</label>
                        <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                        </div>
                    </div>
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                        <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm/6">
                        <label for="offers" class="font-medium text-gray-900">Offers</label>
                        <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                        </div>
                    </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="text-sm/6 font-semibold text-gray-900">Push Notifications</legend>
                    <p class="mt-1 text-sm/6 text-gray-600">These are delivered via SMS to your mobile phone.</p>
                    <div class="mt-6 space-y-6">
                    <div class="flex items-center gap-x-3">
                        <input id="push-everything" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="push-everything" class="block text-sm/6 font-medium text-gray-900">Everything</label>
                    </div>
                    <div class="flex items-center gap-x-3">
                        <input id="push-email" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="push-email" class="block text-sm/6 font-medium text-gray-900">Same as email</label>
                    </div>
                    <div class="flex items-center gap-x-3">
                        <input id="push-nothing" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="push-nothing" class="block text-sm/6 font-medium text-gray-900">No push notifications</label>
                    </div>
                    </div>
                </fieldset>
                </div>
            </div> --}}
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</div>
@endsection
