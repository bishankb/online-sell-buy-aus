@extends('layouts.frontend')

@section('content')
    <div class="account_grid">
        <div class="row">
            <div class="card panel-login">
                <div class=" login-right">
                    <h3>
                       {{ __('Confirm Password') }}
                    </h3>
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }} clearfix ">
                            <span class="login-field control-label">{{ __('Password') }}</span>
                            
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>   
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@endsection
