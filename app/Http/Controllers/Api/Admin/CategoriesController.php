<?php 

namespace App\Http\Controllers\Api\Admin;

use Input;
use App\Category;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
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
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->createCategory();
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
        return Category::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        // $article = Article::findOrFail($id);

        // $article->update($request->all());

        // $this->syncTags($article, $request->input('tag_list'));

        // return redirect('admin/articles/index');
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
        Category::find($id)->delete();
    }

    public function trash()
    {
        // $articles = Article::with('tags', 'category')->onlyTrashed()->latest('deleted_at')->paginate(15);

        // return view('admin.articles.trash', compact('articles'));
    }

    public function restore($id)
    {
        // Article::onlyTrashed()->find($id)->restore();

        // return redirect('admin/articles/index');
    }

    public function createCategory()
    {
        $category = Category::where('name', '=', Input::get('name'))->first();
        if ($category === null) {
           Category::create(Input::all());
        } else {
            $category->update(Input::all());
        }
    }

}
