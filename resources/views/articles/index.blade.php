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
        <h1><a style="color: inherit;" href="{{route('articles.show', [$article->id])}}">{{$article->title}}</a></h1>

        <p>{{$article->content}}</p>
        <ul style="padding: 0; list-style: none">
            <li style="display: inline-block;"><small style="font-style: italic">Publié le {{$article->created_at}}</small></li>
            <li style="float:right"><small style="font-style: italic">By {{$article->user->name}}</small></li>
        </ul>
            <hr>
    @endforeach
        {{$articles->links()}}
    </div>
@endsection