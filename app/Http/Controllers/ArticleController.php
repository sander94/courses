<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::query()->paginate();

        return view('articles.index', compact('articles'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Article $article)
    {
        return view('articles.show', compact('article'));
    }
}
