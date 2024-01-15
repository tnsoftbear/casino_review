<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class BaseUserRequest extends FormRequest
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
            'login' => [
                'required',
                'max:255',
            ],
            'email' => [
                'required',
                'max:255',
                'email',
            ],
            'is_admin' => ['boolean'],
            'is_author' => ['boolean'],
            'first_name' => [],
            'last_name' => [],
        ];
    }
}
