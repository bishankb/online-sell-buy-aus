@extends('layouts.frontend')

@section('content')
    <div class="account_grid">
        <div class="row">
            <div class="card panel-login">
                <div class=" login-right">
                    <h3>
                       {{ __('Reset Password') }}
                    </h3>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }} clearfix ">
                            <span class="login-field control-label">Email Address</span>
                            
                            <input  id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <input type="submit" value="{{ __('Send Password Reset Link') }}">
                    </form>
                </div>   
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@endsection



