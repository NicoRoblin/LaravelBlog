<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        Like::create([
            "article_id" => $id,
            "user_id" => Auth::user()->id,
        ]);

        return redirect(route('articles.show', compact('id')));
    }


    public function destroy($id)
    {
        Like::where(['user_id' => Auth::user()->id],['article_id' => $id])->delete();

        return redirect(route('articles.show', compact('id')));
    }
}
