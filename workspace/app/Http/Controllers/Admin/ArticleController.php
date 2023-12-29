<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Domain\Date\DateTzConverter;
use App\Http\Controllers\Controller;
use App\Domain\Author\Load\AuthorLoader;
use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Http\Requests\Admin\Article\UpdateArticleRequest;
use App\Domain\Constants\DateConstants;

class ArticleController extends Controller
{
    public function __construct(private AuthorLoader $authorLoader) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::whereNull('deleted_at')->get()->all();
        $articles = array_map(fn($article) => $this->prepareForRender($article), $articles);
        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $article = new Article;
        $article->publish_at = now()->format(DateConstants::DT_ZERO_SEC_ISO_FORMAT);
        return view('admin.article.create')
            ->with('pageTitle', 'Create Article')
            ->with('authorUsers', $this->authorLoader->load())
            ->with('article', $this->prepareForRender($article));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $validatedData = $request->validationData();
        $validatedData = $this->prepareForSave($request, $validatedData);
        $article = Article::create($validatedData);
        return $this->redirectAfterSave($request, $article);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('admin.article.edit')
            ->with('article', $this->prepareForRender($article))
            ->with('authorUsers', $this->authorLoader->load())
            ->with('pageTitle', 'Edit Article');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validatedData = $request->validationData();
        $validatedData = $this->prepareForSave($request, $validatedData);
        $article->update($validatedData);
        return $this->redirectAfterSave($request, $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->deleted_at = now();
        $article->save();
        return redirect()->route('article.index');
    }

    protected function redirectAfterSave(Request $request, Article $article) {
        if ($request->save === 'save_and_new') {
            return redirect()->route('article.create');
        }
        if ($request->save == 'save_and_exit') {
            return redirect()->route('article.index');
        }
        return redirect()->route('article.edit', ['article' => $article->id]);
    }

    protected function prepareForSave(Request $request, array $savingData): array 
    {
        $savingData = DateTzConverter::convertAndUpdateArrayOfDateIsoToUtcByTzOffset(
            $savingData,
            ['publish_at', 'unpublish_at'],
            (int)$request->session()->get('tz_offset')
        );
        return $savingData;
    }

    protected function prepareForRender(Article $article): Article {
        $article->publish_at = DateTzConverter::convertDateIsoUtcByTzOffset($article->publish_at, (int)session()->get('tz_offset'));
        $article->unpublish_at = DateTzConverter::convertDateIsoUtcByTzOffset($article->unpublish_at, (int)session()->get('tz_offset'));
        return $article;
    }
}
