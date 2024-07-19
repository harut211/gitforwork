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
            'web_id'=>['required','exists:websites,id'],
            'title'=>['required','unique:posts'],
            'content'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            "web_id.required" => __('validation.website_id_required'),
            "title.required" => __('validation.post_title'),
            "title.unique" => __('validation.post_title_already_exists'),
            "content.required" => __('validation.content_required'),
        ];
    }
}
