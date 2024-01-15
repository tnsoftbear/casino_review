<?php

namespace App\Http\Controllers\Public;

use App\Models\Article;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Domain\Date\DateFormatter;

class ArticleController extends Controller
{
    public function feed()
    {
        $now = Carbon::now();

        $articles = Article::select(
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

        $articleViews = array_map(function ($article) {
            $when = '';
            if (!empty($article['publish_at'])) {
                $publishDate = Carbon::parse($article['publish_at']);
                $when = $publishDate->diffForHumans();
            }
            $author = trim($article['first_name'] . ' ' . $article['last_name']);
            if (!empty($author)) {
                $author = 'by ' . $author;
            }

           return [
               'name' => $article['name'],
               'slug' => $article['slug'],
               'teaser' => $article['teaser'],
               'when' => $when,
               'author' => $author,
           ]; 
        }, $articles);

        return view('public.article.feed')
            ->with('articles', $articleViews);
    }

    public function show(string $slug) {
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
        $article = $articleRows[0] ?? [];
        if (!$article) {
            abort(404);
        }

        $article['meta'] ??= [];
        $article['meta']['title'] = $article['meta_title'] ?: $article['name'];
        $article['meta']['title'] .= ' | ' . __('global.domain_name');
        $article['meta']['description'] = $article['meta_description'] ?: __('public.global.site_description');
        $article['meta']['keywords'] = $article['meta_keywords'] ?: __('public.global.site_keywords');
        if (!empty($article['publish_at'])) {
            $article['meta']['article_published_time'] = DateFormatter::formatDateIsoToIso8601($article['publish_at']);
        }
        if (!empty($article['updated_at'])) {
            $article['meta']['article_modified_time'] = DateFormatter::formatDateIsoToIso8601($article['updated_at']);
        }
        if (!empty($article['unpublish_at'])) {
            $article['meta']['article_expiration_time'] = DateFormatter::formatDateIsoToIso8601($article['unpublish_at']);
        }
        $author = trim($article['first_name'] . ' ' . $article['last_name']);
        // TODO: $article['meta']['article_author'] = здесь урл на страницу автора. Полагаю, в ней должны быть мета таги profile:first_name,last_name,username,gender
        $article['author'] = !empty($author) ? $author : '';
        if (!empty($article['rubric_id'])) {
            // TODO: Перевод рубрики, много рубрик
            $article['meta']['article_section'] = config('article.rubric')[$article['rubric_id']];
        }
        if (!empty($article['tags'])) {
            // TODO: Слова теги по смыслу статьи
            $article['meta']['article_tag'] = $article['tags'];
        }
        return view('public.article.show')
            ->with('article', $article);

    }
}
