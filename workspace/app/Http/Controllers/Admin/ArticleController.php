<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Author\Load\AuthorLoader;
use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Http\Requests\Admin\Article\UpdateArticleRequest;

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
        return view('admin.article.create')
            ->with('pageTitle', 'Create Article')
            ->with('authorUsers', $this->loadAuthorUsers())
            ->with('article', new Article);
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
        session()->flash('slug', "123123");
        return view('admin.article.edit')
            ->with('article', $article)
            ->with('authorUsers', $this->loadAuthorUsers())
            ->with('pageTitle', 'Edit Article');
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
        $authorUsers = AuthorLoader::load();
        return $authorUsers;
    }
}
