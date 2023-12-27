<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rule;

class StoreUserRequest extends BaseUserRequest
{
    public function rules(): array {
        $rules = parent::rules();
        $rules['login'] = Rule::unique('users')->withoutTrashed();
        $rules['email'] = Rule::unique('users')->withoutTrashed();
        $rules['password'] = 'required|min:6|max:255|confirmed';
        return $rules;
    }
}
