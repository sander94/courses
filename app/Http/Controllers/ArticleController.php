<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ArticleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::whereDate('published_at', '>=', Carbon::now())->orderBy('id', 'DESC')->paginate();

        return view('articles.index', compact('articles'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Article $article)
    {        
        // $article = Article::where('id', $request->id);
        dd($request->all());
        return view('articles.show', compact('article'));
    }
}
