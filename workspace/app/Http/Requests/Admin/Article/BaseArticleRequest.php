<?php

namespace App\Http\Requests\Admin\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'content' => '',
            'teaser' => '',
            'published_at' => 'nullable|date',
        ];
    }
}
