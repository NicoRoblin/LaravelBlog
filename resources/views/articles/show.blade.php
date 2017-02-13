@extends('layouts.app')

@section('content')
    <h1 style="text-align: center">Article n°{{ $id }}</h1>
    <div style="width: 50%; margin: 0 auto;">
            <h1>{{$articles->title}}</h1>

            <p>{{$articles->content}}</p>
            <ul style="padding: 0; list-style: none">
                <li style="display: inline-block;"><small style="font-style: italic">Publié le {{$articles->created_at}}</small></li>
                <li style="float:right"><small style="font-style: italic">By {{$articles->user->name}}</small></li>
            </ul>
        @if(Auth::check() && Auth::user()->id == $articles->user_id || Auth::user()->is_admin == true)
        <form class="form-horizontal" role="form" method="POST" action="{{route('articles.destroy', [$articles->id])}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">DELETE</button>
        </form>
        <a class="btn btn-default" href="{{route('articles.edit', [$articles->id])}}">Modifier</a>
        @endif
            <hr>

    </div>
@endsection