@extends('layouts.frontend')

@section('content')
    <div class="account_grid">
        <div class="row">
            <div class="panel panel-primary panel-login">
                <div class=" login-right">
                    <h3>
                       {{ __('Reset Password') }}
                    </h3>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }} clearfix ">
                            <span class="login-field control-label">Email Address</span>
                            
                            <input id="email" type="email"  placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }} clearfix ">
                            <span class="login-field control-label">Password</span>
                            
                            <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ $password ?? old('password') }}" required autofocus>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group required clearfix ">
                            <span class="login-field control-label">Confirm Password</span>

                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <input type="submit" value="{{ __('Reset Password') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection