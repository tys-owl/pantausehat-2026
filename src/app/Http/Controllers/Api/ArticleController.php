<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()->latest()->paginate(10);

        return ArticleResource::collection($articles);
    }

    public function show(Article $article)
    {
        abort_unless($article->status === 'published', 404);

        return new ArticleResource($article);
    }
}
