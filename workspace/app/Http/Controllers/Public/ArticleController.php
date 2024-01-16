<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Domain\Article\Load\ArticleLoader;
use App\Domain\Article\View\Public\ArticlePublicViewPreparer;

class ArticleController extends Controller
{
    public function feed(
        ArticleLoader $articleLoader,
        ArticlePublicViewPreparer $articlePublicViewPreparer
    ) {
        $articleRows = $articleLoader->loadRowsForPublicList();
        $articleViews = $articlePublicViewPreparer->prepareListData($articleRows);
        return view('public.article.feed')
            ->with('articles', $articleViews);
    }

    public function show(
        string $slug,
        ArticleLoader $articleLoader,
        ArticlePublicViewPreparer $articlePublicViewPreparer
    ) {
        $articleRow = $articleLoader->loadRowForPublicView($slug);
        if (!$articleRow) {
            abort(404);
        }

        $articleData = $articlePublicViewPreparer->prepareViewData($articleRow);
        return view('public.article.show')
            ->with('article', $articleData);
    }
}
