<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Validation\Rule;

class StoreArticleRequest extends BaseArticleRequest
{
    public function rules(): array
    {
        $rules = parent::rules();
        $rules['name'][] = Rule::unique('article')->withoutTrashed();
        $rules['slug'][] = Rule::unique('article')->withoutTrashed();
        return $rules;
    }
}
