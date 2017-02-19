<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $article_id
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $id)
    {
        $this->validate($request,
            [
                'content'=>'required'
            ],
            [
                'content.required'=>'Un contenu est requis'
            ]);

        Comment::create([
            "content" => $request->get('content'),
            "article_id" => $id,
            "user_id" => Auth::user()->id,
        ]);


        return redirect()->route('articles.show', compact('id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comments= Comment::find($id);
        return view('comments.edit', compact('comments', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'content'=>'required'
            ],
            [
                'content.required'=>'Un contenu est requis'
            ]);

        $comment = Comment::where('id', $id)->update([
            "content"=>$request->get("content")
        ]);

        $req = Comment::find($id);
        $id_article = $req->article_id;

        if(!$comment){
            return redirect()->route('articles.show', compact('id_article'));
        }


        return redirect()->route('articles.show', compact('id_article'))->with('status', 'Post updated with success !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = Comment::find($id);
        $id_article = $req->article_id;
        Comment::where('id', $id)->delete();

        return redirect()->route('articles.show', compact('id_article'));
    }
}
