<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string',
            'genre' => 'required|string',
            'isbn' => 'required|numeric|digits:13',
            'description' => 'required|string|max:255',
            'published' => 'required',
            'publisher' => 'required|string',
            'image' => 'required||mimes:jpg,jpeg,png|max:2000',
        ];
    }
}
