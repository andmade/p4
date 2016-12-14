@extends('layouts.master')

@section('content')
<form class="ink-form" id="loginForm" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    
    <div class="control-group all-50 required">
        <label for="email">Email Address</label>
        <div class="control">
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
        </div>
        @if ($errors->has('email'))
        <span class="error-message">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div> 

    <div class="control-group all-50 required">
        <label for="password">Password</label>
        <div class="control">
            <input id="password" type="password" name="password" required />
        </div>
        @if ($errors->has('password'))
        <span class="error-message">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>

    <div class="control-group all-50">
        <ul class="control unstyled">
            <li><input type="checkbox" id="remember" name="remember" value="{{ old('remember') }}"/><label for="remember">Remember Me</label></li>
        </ul>
    </div>

    <div class="control-group all-50 required">
        <button type="submit" class="ink-button blue">Login</button>
        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
    </div>    
</form>
@endsection