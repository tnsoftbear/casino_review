<?php
declare(strict_types=1);

namespace App\Domain\Article\Load;

use Carbon\Carbon;
use App\Models\Article;

class ArticleLoader
{
    public function loadRowsForPublicList(): array
    {
        $now = Carbon::now();
        $articleRows = Article::select(
            'article.name',
            'article.slug',
            'article.teaser',
            'article.publish_at',
            'user_personal.first_name',
            'user_personal.last_name',
        )
            ->join('users', 'article.author_user_id', '=', 'users.id')
            ->join('user_personal', 'users.id', '=', 'user_personal.user_id')
            ->where('users.is_author', true)
            ->where(function ($query) use ($now) {
                $query->where('article.publish_at', '<=', $now)->orWhereNull('article.publish_at');
            })
            ->where(function ($query) use ($now) {
                $query->where('article.unpublish_at', '>', $now)->orWhereNull('article.unpublish_at');
            })
            ->whereNull('article.deleted_at')
            ->get()
            ->toArray();
        return $articleRows;
    }

    public function loadRowForPublicView(string $slug): array
    {
        $now = Carbon::now();
        $articleRows = Article::select(
            'article.name',
            'article.content',
            'article.rubric_id',
            'article.publish_at',
            'article.updated_at',
            'article.unpublish_at',
            'article.meta_title',
            'article.meta_description',
            'article.meta_keywords',
            'user_personal.first_name',
            'user_personal.last_name',
        )
            ->join('users', 'article.author_user_id', '=', 'users.id')
            ->join('user_personal', 'users.id', '=', 'user_personal.user_id')
            ->where('users.is_author', true)
            ->where(function ($query) use ($now) {
                $query->where('article.publish_at', '<=', $now)->orWhereNull('article.publish_at');
            })
            ->where(function ($query) use ($now) {
                $query->where('article.unpublish_at', '>', $now)->orWhereNull('article.unpublish_at');
            })
            ->where('article.slug', '=', $slug)
            ->whereNull('article.deleted_at')
            ->get()
            ->toArray();
        $articleRow = $articleRows[0] ?? [];
        return $articleRow;
    }
}