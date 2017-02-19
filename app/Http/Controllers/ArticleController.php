<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(5);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Un titre est requis',
                'content.required' => 'Un contenu est requis'
            ]);


        $article = Article::create([
            "title" => $request->title,
            "content" => $request->get('content'),
            "user_id" => Auth::user()->id
        ]);

        $id = '' . $article->id . '';

        $ext = $request->file('fileToUpload')->extension();

        $filename = $id.".".$ext;

        $test = Storage::disk('uploads')->put($id, $request->file('fileToUpload'));



        var_dump($test);


        // Article::where('content', $request->get('content'))->update(['img_path' => $test]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles = Article::find($id);
        return view('articles.show', compact('articles', 'id'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articles = Article::find($id);
        return view('articles.edit', compact('articles', 'id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Un titre est requis',
                'content.required' => 'Un contenu est requis'
            ]);

        $article = Article::where('id', $id)->update([
            "title" => $request->title,
            "content" => $request->get("content")
        ]);

        if (!$article) {
            return redirect()->route('articles.index');
        }


        return redirect()->route('articles.index')->with('status', 'Post updated with success !');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::where('id', $id)->delete();

        return redirect()->route('articles.index');
    }
}
