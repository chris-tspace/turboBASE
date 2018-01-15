@extends('layouts.master')

@section('content')
<div class="login-box">
    <div class="login-logo">
        {{ config('app.name') }}
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST" action="{{ route('login') }}">
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

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>

            <div class="form-group has-feedback">
                <button type="submit" class="btn btn-primary btn-block" onclick="buildinput(this.form)">
                    Login
                </button>
            </div>

            <div class="form-group has-feedback">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Forgot Your Password?
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