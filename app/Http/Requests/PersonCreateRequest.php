<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PersonCreateRequest extends FormRequest
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

            'FIO' => ['required', 'regex:/[a-zа-яA-ZА-Я _\-]?/'],
            'Staff' => 'required',
            'Phone' => ['required', 'regex:/\+7|8\s([0-9]{3})\s[0-9]{3}-[0-9]{2}-[0-9]{2}/'],
            'Stage' => 'required|min:0',
            'Image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'FIO.required' => 'Обязательно к заполнению',
            'FIO.regex' => 'Допустима только кириллица и латиница',

            'Staff.required' => 'Обязательно к заполнению',
            'Staff.numeric' => 'допустимы только цифры',

            'Phone.required' => 'Обязательно к заполнению',
            'Phone.regex' => 'Допускается только русский формат телефона',

            'Stage.required' => 'Обязательно к заполнению',
            'Stage.numeric' => 'Допускается только числа',
            'Stage.min' => 'Не может быть меньше 0',

            'Image.required' => 'Обязательно к заполнению',
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
