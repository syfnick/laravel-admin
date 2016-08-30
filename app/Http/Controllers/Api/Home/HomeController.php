<?php 

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $page_size = setting('page_size');

        $articles = \App\Article::with('category')->latest()->take($page_size)->get();

        return $articles;
    }

    public function about()
    {
        $site_description = setting('site_description');

        return $site_description;
    }
}
