@extends('layouts.app')

@section('content')
    <h1 style="text-align: center;">Liste des articles</h1>
    <div style="width: 50%; margin: 0 auto;">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>

        @endif
        @foreach($articles as $article)
            <h1><a style="color: inherit;" href="{{route('articles.show', [$article->id])}}">{{$article->title}}</a>
            </h1>
                <img src="../../..{{$article->img_path}}" alt="" style="height:  50px;width: auto;">

            <p>{{$article->content}}</p>
            <ul style="padding: 0; list-style: none">
                <li style="display: inline-block;">
                    <small style="font-style: italic">Publié le {{$article->created_at}}</small>
                </li>
                <li style="float:right">
                    <small style="font-style: italic">By {{$article->user->name}}</small>
                </li>
            </ul>
            <div style="width: 100% ;font-size: 0.8em; padding-left: 5%; background-color: white;">
                @if(count($article->comments) > 0)
                    <a href="{{route('articles.show', [$article->id])}}">{{count($article->comments)}} commentaire(s)</a>
                @else
                    <p>Pas de commentaires</p>
                @endif

                    @if(count($article->likes) > 0)
                        <p>{{count($article->likes)}} like(s)</p>
                    @else
                        <p>Pas de likes</p>
                    @endif

            </div>
                <hr>
        @endforeach
        {{$articles->links()}}
    </div>
@endsection