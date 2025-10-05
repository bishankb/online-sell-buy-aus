@extends('layouts.frontend')

@section('content')
    <div class="account_grid">
        <div class="row">
            <div class="card panel-login">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <div class=" login-right">
                    <h3>
                        @if (request('old_user') == 'yes')
                            Account activation is pending !!
                        @else
                            Please confirm your registration.
                        @endif
                    </h3>

                    <p>
                        Confirmation link has been sent to your email address.<br>
                        Please check your inbox and verify your registration.
                    </p>

                    <h3>Not getting email?</h3>
                    <p>Please check your bulk mail or spam folder first. 
                        <form action="{{ route('verification.resend') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{request('email')}}">
                            <span>Click the button to resend the email. (It may take a few minutes to arrive.)</span><br><br>
                            <input type="submit" value="Resend" style="margin-top: 0">
                        </form>
                    </p>
                </div>   
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@endsection
