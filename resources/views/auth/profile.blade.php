@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h1>{{ Auth::user()->name }}</h1>
                        <h2>{{ Auth::user()->email }}</h2>
                        <h3>{{ Auth::user()->created_at }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h1 style="text-align: center;">Liste des articles</h1>
    <div style="width: 50%; margin: 0 auto;">
        @foreach($articles as $article)
            <h1>{{$article->title}}</h1>

            <p>{{$article->content}}</p>
            <ul style="padding: 0; list-style: none">
                <li style="display: inline-block;"><small style="font-style: italic">Publié le {{$article->created_at}}</small></li>
            </ul>
            <hr>
        @endforeach
    </div>
@endsection