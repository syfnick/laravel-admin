<?php 

namespace App\Http\Controllers\Api\Admin;

use Input;
use App\Article;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Article::with('category', 'user')->latest()->paginate(15);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function all()
    {
        return Article::with('category', 'user')->latest()->get();
    }

    /**
    * @return \Illuminate\View\View
    */
    public function create()
    {
        // $tags = Tag::lists('name','id');
        // return view('article.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // $rules = array(
        //     'name'       => 'required',
        //     'email'      => 'required|email',
        //     'nerd_level' => 'required|numeric'
        // );

        $this->createArticle();
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
        return Article::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        $categories = \App\Category::getLeveledCategories();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        $article->update($request->all());

        $this->syncTags($article, $request->input('tag_list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try 
        {
            $article = Article::findOrFail($id);
            $article->delete();
            
            return 'Delete succeeded';
        } 
        catch(ModelNotFoundException $e) 
        {
            return ['error' => 'Error while uploading file'];
        }
    }

    public function trash()
    {
        $articles = Article::with('user', 'category')->onlyTrashed()->latest('deleted_at')->paginate(15);

        return $articles;
        // return view('admin.articles.trash', compact('articles'));
    }

    public function restore($id)
    {
        Article::onlyTrashed()->find($id)->restore();
    }

    public function forceDelete($id)
    {
        Article::onlyTrashed()->find($id)->forceDelete();
    }

    public function syncTags(Article $article, array $tags)
    {
        foreach ($tags as $key => $tag) {
            if (!is_numeric($tag)) {
                $newTag = \App\Tag::create(['name' => $tag, 'slug' => $tag]);
                $tags[$key] = $newTag->id;
            }
        }

        $article->tags()->sync($tags);
    }

    public function createArticle()
    {
        $article = \Auth::user()->articles()->create(Input::all());
        $article->update(array('slug' => str_slug($article->title, '_')));
    }
}
