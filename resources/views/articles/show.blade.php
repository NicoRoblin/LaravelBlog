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
                  action="{{ route('comments.add', [$articles->id]) }}">
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
            @if(count($articles->likes) > 0)
                <p>{{count($articles->likes)}} like(s)</p>
            @else
                <p>Pas de likes</p>
            @endif
            @if(Auth::check())
                <?php $value = false; ?>
                @forelse(Auth::user()->likes as $like)
                    @if($like->user_id == Auth::user()->id && $like->article_id == $articles->id)
                        <p>Vous aimez déjà</p>
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{route('likes.destroy', [$articles->id])}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Je n'aime plus</button>
                        </form>
                        <?php $value = true; ?>

                    @endif
                @empty
                    <form action="{{ route('likes.store', [$articles->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">J'aime</button>
                    </form>
                    <?php $value = true; ?>

                @endforelse
                @if($value == false)
                    <form action="{{ route('likes.store', [$articles->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary">J'aime</button>
                    </form>
                @endif
            @endif


        </div>
        @include('components.share', ['url' => request()->fullUrl(),])

        <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
        <script>

            var popupSize = {
                width: 500,
                height: 350
            };

            $(document).on('click', '.social-buttons > a', function (e) {

                var
                        verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                        horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

                var popup = window.open($(this).prop('href'), 'social',
                        'width=' + popupSize.width + ',height=' + popupSize.height +
                        ',left=' + verticalPos + ',top=' + horisontalPos +
                        ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

                if (popup) {
                    popup.focus();
                    e.preventDefault();
                }

            });
        </script>

    </div>
@endsection

