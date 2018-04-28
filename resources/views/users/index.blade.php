@extends('layouts.default')

@section('title', 'all user')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1>all user</h1>
        <ul class="users">
            @foreach($users as $user)
                @include('users._user')
            @endforeach

            {!! $users->render() !!}
        </ul>
    </div>
@stop

