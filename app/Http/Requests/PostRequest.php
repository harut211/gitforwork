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
            'title'=>['required','string','max:255'],
            'content'=>['required','string'],
        ];
    }

    public function messages(): array
    {
        return [
            "web_id.required" => __('validation.website_id_required'),
            "title.required" => __('validation.post_title'),
            "title.string" => __('validation.post_title_must_be_string'),
            "title.max" => __('validation.post_title_max_255'),
            "content.required" => __('validation.content_required'),
            "content.string" => __('validation.content_must_be_string'),
        ];
    }
}
