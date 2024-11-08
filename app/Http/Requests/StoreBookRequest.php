<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title'         => ['required', 'string', 'max:255'],
            'isbn'          => ['required', 'alpha_num', 'max:10'],
            'isbn_13'       => ['required', 'alpha_num', 'max:13'],
            'published_at'  => ['required', 'date'],
            'publisher_id'  => ['required','exists:App\Models\Publisher,id'],
            'language_id'   => ['required','exists:App\Models\Language,id'],
            'price'         => ['required'], //'decimal:2,10'
            'description'   => ['nullable', 'string'],
            'authors_id'    => ['required']

        ];
    }
}
