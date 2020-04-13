<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

// import GitDown dependency
use GitDown;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         //query the database
        $articles = Article::orderByDesc('updated_at')->where('online', true)->get();
        //return the view passing the list of articles
        return view ('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //I'm just validating the presence of the title, but you can validate more fields
        $request->validate([
            'title'=> 'required',
          ]);

        //create new Article instance and assign values
        $article = new Article;
        $article->title = $request->title;
        $article->body_md = $request->body;
        $article->summary_md = $request->summary;
        $article->online = $request->online;
        //generate article slug for nice URLs
        $article->slug = str_slug($article->title, '-') . '-' . $article->id;

        //parse body and summary to HTML via GitHub API
        $article->body_html = GitDown::parseAndCache($request->body) ;
        $article->summary_html = GitDown::parseAndCache($request->summary); 

        //save article
        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($param)
    {
        //seach by id or the slug
        $articleFound = Article::where('id', $param)
                        ->orWhere('slug', $param)
                        ->firstOrFail();
		    if ($articleFound->online){
            //if article is published, go to article page
            return view('articles.show', ['article' => $articleFound]);
        }
						
        //if article not published, redirect to articles.index page
        return redirect()->route('articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
