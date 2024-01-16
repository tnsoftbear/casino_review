<?php

declare(strict_types=1);

namespace App\Domain\Article\View\Public;

use Carbon\Carbon;
use App\Domain\Date\DateFormatter;

class ArticlePublicViewPreparer
{
    public function prepareListData(array $articleRow): array
    {
        $articleViews = array_map(function ($articleRow) {
            $when = '';
            if (!empty($articleRow['publish_at'])) {
                $publishDate = Carbon::parse($articleRow['publish_at']);
                $when = $publishDate->diffForHumans();
            }
            $author = trim($articleRow['first_name'] . ' ' . $articleRow['last_name']);
            if (!empty($author)) {
                $author = 'by ' . $author;
            }

            return [
               'name' => $articleRow['name'],
               'slug' => $articleRow['slug'],
               'teaser' => $articleRow['teaser'],
               'when' => $when,
               'author' => $author,
            ]; 
        }, $articleRow);
        return $articleViews;
    }

    public function prepareViewData(array $articleRow): array
    {
        $articleRow['meta'] ??= [];
        $articleRow['meta']['title'] = $articleRow['meta_title'] ?: $articleRow['name'];
        $articleRow['meta']['title'] .= ' | ' . __('global.domain_name');
        $articleRow['meta']['description'] = $articleRow['meta_description'] ?: __('public.global.site_description');
        $articleRow['meta']['keywords'] = $articleRow['meta_keywords'] ?: __('public.global.site_keywords');
        if (!empty($articleRow['publish_at'])) {
            $articleRow['meta']['article_published_time'] = DateFormatter::formatDateIsoToIso8601($articleRow['publish_at']);
        }
        if (!empty($articleRow['updated_at'])) {
            $articleRow['meta']['article_modified_time'] = DateFormatter::formatDateIsoToIso8601($articleRow['updated_at']);
        }
        if (!empty($articleRow['unpublish_at'])) {
            $articleRow['meta']['article_expiration_time'] = DateFormatter::formatDateIsoToIso8601($articleRow['unpublish_at']);
        }
        $author = trim($articleRow['first_name'] . ' ' . $articleRow['last_name']);
        // TODO: $articleRow['meta']['article_author'] = здесь урл на страницу автора. Полагаю, в ней должны быть мета таги profile:first_name,last_name,username,gender
        $articleRow['author'] = !empty($author) ? $author : '';
        if (!empty($articleRow['rubric_id'])) {
            // TODO: Перевод рубрики, много рубрик
            $articleRow['meta']['article_section'] = config('article.rubric')[$articleRow['rubric_id']];
        }
        if (!empty($articleRow['tags'])) {
            // TODO: Слова теги по смыслу статьи
            $articleRow['meta']['article_tag'] = $articleRow['tags'];
        }
        return $articleRow;
    }
}