<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Validation\Rule;

class UpdateArticleRequest extends BaseArticleRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $id = $this->route('article')->id;
        $rules['name'][] = Rule::unique('article')->ignore($id)->withoutTrashed();
        $rules['slug'][] = Rule::unique('article')->ignore($id)->withoutTrashed();
        return $rules;
    }
}
