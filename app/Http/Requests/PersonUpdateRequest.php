<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PersonUpdateRequest extends FormRequest
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

            'FIO' => ['regex:/[a-zа-яA-ZА-Я _\-]?/'],
            'Staff' => 'numeric',
            'Stage' => 'required|min:0',
            'Phone' => ['regex:/\+7|8\s([0-9]{3})\s[0-9]{3}-[0-9]{2}-[0-9]{2}/'],
            'Image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'FIO.regex' => 'Допустима только кириллица и латиница',

            'Staff.numeric' => 'допустимы только цифры',

            'Phone.regex' => 'Допускается только русский формат телефона',

            'Image.image' => 'Не является изображением',
            'Image.mimes' => 'Допускаемые типы: jpeg, png, jpg, gif',
            'Image.max' => 'Превышен макс. размер в 2МБ'
        ];
    }

    protected function prepareForValidation(): void
    {
        foreach ($this->request->getIterator() as $key => $value) {
            $this[$key] = trim($value, '_');
        }
    }
}
