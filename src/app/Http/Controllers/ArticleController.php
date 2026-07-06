<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index', [
            'articles' => Article::published()->latest()->paginate(9),
        ]);
    }

    public function show(Article $article)
    {
        abort_unless($article->status === 'published', 404);

        return view('articles.show', compact('article'));
    }
}
