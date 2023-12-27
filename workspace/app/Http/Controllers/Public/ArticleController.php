<?php
namespace App\Http\Controllers;

class ArticleController extends Controller
{
    public function index(string $slug = "")
    {
        return view('article.index', compact('slug'));
    }
}