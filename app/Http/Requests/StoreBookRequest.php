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
            'stock_qty'     => ['required'],
            'description'   => ['nullable', 'string'],
            'authors_id'    => ['required'],
            'authors_id.*'  => ['exists:App\Models\Author,id'],
            'image'         => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:10240'], // 最大 10MB

        ];
    }
    public function messages(): array
    {
        return [
            'image.image' => '請上傳有效的圖片檔案',
            'image.mimes' => '圖片格式必須是 jpeg, png, jpg 或 gif',
            'image.max' => '圖片大小不能超過 10MB',
            'authors_id.required' => '請至少選擇一位作者',
            'authors_id.*.exists' => '選擇的作者不存在',
        ];
    }
}
