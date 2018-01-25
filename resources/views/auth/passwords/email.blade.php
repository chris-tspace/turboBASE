@extends('layouts.master')

@section('content')
<div class="login-box">
    <div class="login-logo">
        {{ config('app.name') }}
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Reset Password</p>

        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>


            <div class="form-group has-feedback">
                <button type="submit" class="btn btn-primary btn-block">
                    Send Password Reset Link
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
