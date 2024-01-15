<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BaseArticleRequest extends FormRequest
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
            'name' => [
                'required',
                'max:255',
            ],
            'slug' => [
                // 'sometimes', // Правило будет применяться только если поле присутствует во входных данных
                // 'nullable',  // Разрешаем поле быть null
                'max:255',
                Rule::requiredIf(function () {
                    // Применяем правило только если поле не пустое
                    return !empty($this->input('slug'));
                }),
            ],
            'rubric_id' => Rule::in(array_keys(config('article.rubric'))),
            'author_user_id' => '',
            'content' => '',
            'teaser' => '',
            'publish_at' => 'nullable|date',
            'unpublish_at' => 'nullable|date',
            'tz_offset' => 'integer',
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['slug' => $this->makeSlug()]);
    }

    protected function failedValidation(Validator $validator) {
        $this->session()->flash('failed_slug', $this->makeSlug());
        parent::failedValidation($validator);
    }

    private function makeSlug() {
        $slug = $this->input('slug');
        if (empty($slug)) {
            $slug = Str::slug($this->input('name'));
        }
        return $slug;
    }
}
