@extends('layouts.default')

@section('title', $title)

@section('content')
<div class="col-md-8 col-md-offset-2">
    <h1>{{ $title }}</h1>
    <ul class="users">
        @foreach ($users as $user)
            <li>
                <img src="{{ $user->gravatar(50) }}" alt="{{ $user->name }}" class="gavatar">
                <a href="{{ route('users.show', $user->id) }}" class="username">{{ $user->name }}</a>
            </li>
        @endforeach
    </ul>

    {!! $users->render() !!}
</div>
@stop