@extends('layouts.app')

@section('content')
    <h1 style="text-align: center;">Messages</h1>
    @forelse($messages as $message)
        @if($message->for_user_id == Auth::user()->id)
        <h2 class="text-center">{{$message->user->name}}</h2>
        <p class="text-center">{{$message->content}}</p>
        @endif

    @empty
        <p class="text-center">Vous n'avez pas de messages ...</p>
    @endforelse
@endsection