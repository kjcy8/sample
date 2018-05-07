@extends('layouts.default')

@section('title', 'login')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>login</h5>
            </div>
            <div class="panel-body">
                @include('shared._errors')

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <lable for="email">email：</lable>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <lable for="email">password：</lable>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="remember">remember me</label>
                        <label><a href="{{ route('password.request') }}">forgot password</a></label>
                    </div>

                    <button type="submit" class="btn btn-primary">login</button>

                </form>

                <hr>

                <p>New to Laravel? <a href="{{ route('signup') }}">Sign up now »</a></p>
            </div>
        </div>
    </div>
@stop