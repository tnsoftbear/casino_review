<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends BaseUserRequest
{
    public function rules(): array {
        $rules = parent::rules();
        $rules['password'] = 'min:6|max:255|confirmed';
        return $rules;
    }
}
