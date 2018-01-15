@extends('layouts.master')

@section('content')
<div class="login-box">
    <div class="login-logo">
        {{ config('app.name') }}
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
                <input
                    id="username"
                    type="text"
                    class="form-control"
                    style="text-transform:uppercase"
                    name="username"
                    placeholder="Username"
                    value="{{ old('username') }}"
                    required
                    autofocus>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>

                @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <input id="name" type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <button type="submit" class="btn btn-primary btn-block" onclick="buildinput(this.form)">
                    Register
                </button>
            </div>

            <div class="form-group has-feedback">
                <a class="btn btn-link" href="{{ route('login') }}">
                    I already have a membership
                </a>
            </div>

        </form>
    </div>
</div>

@endsection

@section('js')
<script>
  function buildinput(form) {
    form.username.value = form.username.value.toUpperCase();
  }
</script>
@endsection