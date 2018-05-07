@extends('layouts.default')

@section('title', 'Reset Password')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">reset password</div>
            <div class="panel-body">
                @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">email：</label>
                        <div class="col-md-6">
                            <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}">

                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection