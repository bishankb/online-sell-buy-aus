@extends('layouts.user-dashboard')

@section('user-dashboard-content')
	<div class="user-dashboard-body">
	    <h5 class="header-section">
	    	Change your Password
	    </h5>
	    <form method="POST" action="{{ route('my-account.updatePassword') }}" class="lg-form-field">
	    @csrf
        @method('PATCH')
	        @if ($errors->any())
			    <div class="callout callout-danger">
			        <strong>Whoops!</strong> There were some problems with your input:
			        <ul class="mb-0">
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			    <br>
			@endif

	    	<div class="row">
			    <div class="col-md-12">
			        <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }} clearfix ">
            			<label for="password" class="form-label">New Password</label>
            			
            			<input type="password" required name="password" value="" class="form-control">

			            @if ($errors->has('password'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('password') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>

			    <div class="col-md-12">
			        <div class="form-group required {{ $errors->has('password_confirmation') ? ' has-error' : '' }} clearfix ">
            			<label for="password_confirmation" class="form-label">Confirm Password</label>

            			<input type="password" name="password_confirmation" class="form-control" required>

			            @if ($errors->has('password_confirmation'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('password_confirmation') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>
			</div>
			
			<div class="text-center">
			    <button type="submit" class="btn btn-success save">Change</button>
			</div>
		</form>
	</div>
@endsection
