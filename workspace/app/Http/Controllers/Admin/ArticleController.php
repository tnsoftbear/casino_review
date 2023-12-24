<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Http\Requests\Admin\Article\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * TODO:
 * published_at - convert to UTC on save, convert to local TZ on display
 */

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::whereNull('deleted_at')->get();
        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authorUsers = $this->loadAuthorUsers();
        $authorUserId = old('author_user_id');
        $content = old('content');
        $name = old('name');
        $pageTitle = 'Create Article';
        $publishedAt = old('published_at');
        $rubricId = old('rubric_id');
        $slug = old('slug');
        $teaser = old('teaser');
        $article = new Article;
        return view('admin.article.create', compact(
            'article',
            'authorUsers',
            'authorUserId', 
            'content', 
            'name', 
            'pageTitle',
            'publishedAt',
            'rubricId', 
            'slug',
            'teaser', 
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $validatedData = $request->validationData();
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
        $authorUsers = $this->loadAuthorUsers();
        $authorUserId = old('author_user_id', $article->author_user_id);
        $content = old('content', $article->content);
        $name = old('name', $article->name);
        $pageTitle = 'Edit Article';
        $publishedAt = old('published_at', $article->published_at);
        $rubricId = old('rubric_id', $article->rubric_id);
        $slug = old('slug', $article->slug);
        $teaser = old('teaser', $article->teaser);
        return view('admin.article.edit', compact(
            'article',
            'authorUsers',
            'authorUserId', 
            'content', 
            'name', 
            'pageTitle',
            'publishedAt',
            'rubricId', 
            'slug',
            'teaser', 
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validatedData = $request->validationData();
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

    protected function loadAuthorUsers() {
        $authorUsers = [];
        return $authorUsers;
    }
}
