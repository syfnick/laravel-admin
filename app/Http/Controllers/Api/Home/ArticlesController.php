<?php

namespace App\Http\Controllers\Api\Home;

use App\Article;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $page_size = setting('page_size');

        $articles = Article::with('category', 'user')->latest()->paginate($page_size);

        return $articles;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $article = Article::with('user')->get()->find($id);

        return $article;
    }

    public function createNew($slug)
    {
        $article = Article::with('user')->findBySlug($slug);

        return $article;
    }
}
