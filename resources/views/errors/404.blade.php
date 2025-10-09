@extends('layouts.error')

@section('content')
    <div class="main">
        <h3>{{ env('APP_NAME') }}</h3>
        <h1>404 ERROR</h1>
        <p>Oooooops! Looks like nothing was found at this location.<br>
        <span>Go to <a href="{{route('frontend.home')}}">Home Page</a></span>
        </p>
    </div>
@endsection