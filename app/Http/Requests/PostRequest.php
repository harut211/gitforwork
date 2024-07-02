<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'web_id'=>'required',
            'title'=>'required',
            'content'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            "web_is.required" =>"web id is required",
            "title.required" =>"web id is required",
            "content.required" =>"web id is required"
        ];
    }
}
