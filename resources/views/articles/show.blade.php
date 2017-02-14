@extends('layouts.app')

@section('content')
    <h1 style="text-align: center">Article n°{{ $id }}</h1>
    <div style="width: 50%; margin: 0 auto;">
        <h1>{{$articles->title}}</h1>

        <p>{{$articles->content}}</p>
        <ul style="padding: 0; list-style: none">
            <li style="display: inline-block;">
                <small style="font-style: italic">Publié le {{$articles->created_at}}</small>
            </li>
            <li style="float:right">
                <small style="font-style: italic">By {{$articles->user->name}}</small>
            </li>
        </ul>
        @if(Auth::check() && (Auth::user()->id == $articles->user_id || Auth::user()->is_admin == true))
            <form class="form-horizontal" role="form" method="POST"
                  action="{{route('articles.destroy', [$articles->id])}}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
            <a class="btn btn-default" href="{{route('articles.edit', [$articles->id])}}">Modifier</a>
            <hr>
            <form class="form-horizontal" role="form" method="POST"
                  action="{{ route('comments.store', [$articles->id]) }}">
                {{ csrf_field() }}
                @include('messages.errors')
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-4 control-label">Content</label>

                    <div class="col-md-5">
                        <textarea id="content" class="form-control" name="content"></textarea>
                        @if ($errors->has('content'))
                            <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2 col-md-offset-8">
                        <button type="submit" class="btn btn-default">Publier</button>
                    </div>
                </div>
            </form>

        @endif
        <hr>
        <div style="width: 100% ;font-size: 0.8em; padding-left: 5%;">
            @forelse($articles->comments as $comment)
                <p>{{$comment->content}}</p>
                <ul style="padding: 0; list-style: none">
                    <li style="display: inline-block;">
                        <small style="font-style: italic">Publié le {{$comment->created_at}}</small>
                    </li>
                    <li style="float:right">
                        <small style="font-style: italic">By {{$comment->user->name}}</small>
                    </li>
                </ul>
                @if(Auth::check() && (Auth::user()->id == $articles->user_id || Auth::user()->is_admin == true))
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{route('comments.destroy', [$comment->id])}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                    <a class="btn btn-default" href="{{route('comments.edit', [$comment->id])}}">Modifier</a>
                @endif
                <hr>
            @empty
                <p>Pas de commentaires</p>
            @endforelse

        </div>

    </div>
@endsection

