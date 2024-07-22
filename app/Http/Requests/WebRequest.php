<?php

namespace App\Http\Requests;

use App\Rules\AlreadySubscribe;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebRequest extends FormRequest
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
            "web_id" => ["required","exists:websites,id"],
            "user_id" => ["required","exists:users,id",],
        ];
    }

    public function messages(): array
    {
        return[
            "user_id.required"=> __('validation.user_id_required'),
            "web_id.required"=> __('validation.website_id_required'),
            "web_id.exists"=> __('validation.website_id_exists'),
            "user_id.exists"=> __('validation.user_id_exists'),
        ];
    }
}
