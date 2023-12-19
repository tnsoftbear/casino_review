<?php
namespace App\Http\Controllers;

class ArticleController extends Controller
{
    public function index(string $slug = "")
    {
        // if (is_numeric($slug)) {
        //     return "Article id: $slug";
        // }
        // return "Article slug: $slug"; 
        return view('article.index', compact('slug'));
    }
}