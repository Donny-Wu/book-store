<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\Chanel;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class UploadChanelRequest extends FormRequest
{
    private $momo_rules = [
        'file'         => ['required', 'mimetypes:text/plain,text/csv', 'max:10000'],
    ];
    private $elite_rules = [
        'file'         => ['required', 'mimetypes:xls', 'max:10000'],
    ];
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
        return match($this->route('service')) {
            Chanel::MOMO->value  => $this->momo_rules,
            Chanel::ELITE->value => $this->elite_rules
        };
    }
    protected function failedValidation(Validator $validator){
        // dd($validator->errorBag());
        $validator->errors()->add('service',$this->route('service'));
        throw (new ValidationException($validator));
    }
}
