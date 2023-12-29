<?php

namespace App\Http\Controllers\Public;

use App\Models\Article;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

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

        $a = array_map(function ($article) {
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
            ->with('articles', $a);
    }
}
