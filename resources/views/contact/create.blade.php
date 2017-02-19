@extends('layouts.app')

@section('content')
    <h1 style="text-align: center; margin-bottom: 5vh;">Contact</h1>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('contact.store') }}">
        {{ csrf_field() }}
        @include('messages.errors')
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-4 control-label">Title</label>

            <div class="col-md-5">
                <input id="title" type="text" class="form-control" name="title">
                @if ($errors->has('title'))
                    <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                @endif
            </div>
        </div>
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
                <button type="submit" class="btn btn-default">Envoyer</button>
            </div>
        </div>
    </form>
@endsection