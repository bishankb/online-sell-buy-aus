@extends('layouts.user-dashboard')

@section('user-dashboard-content')
	<div class="user-dashboard-body">
	    <h5 class="header-section">
	    	Update your profile
	    </h5>
	    <form method="POST" action="{{ route('my-account.updateProfile') }}" class="lg-form-field" enctype="multipart/form-data">
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
			        <div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }} clearfix ">
            			<label for="name" class="form-label">Full Name</label>

             			<input type="text" required name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control">

			            @if ($errors->has('name'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('name') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>
	    	</div>
		    <div class="row">
			    <div class="col-md-6">
			        <div class="form-group {{ $errors->has('phone1') ? ' has-error' : '' }} clearfix ">
            			<label for="phone1" class="form-label">Phone Number</label>

            			<input type="text" name="phone1" value="{{ old('phone1', $userProfile->phone1 ?? '') }}" class="form-control">

			            @if ($errors->has('phone1'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('phone1') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>

			    <div class="col-md-6">
			        <div class="form-group {{ $errors->has('phone2') ? ' has-error' : '' }} clearfix ">
           				<label for="phone2" class="form-label">Secondary Phone Number</label>

            			<input type="text" name="phone2" value="{{ old('phone2', $userProfile->phone2 ?? '') }}" class="form-control">

			            @if ($errors->has('phone2'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('phone2') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>
			</div>

			<div class="row">
			    <div class="col-md-12">
			        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }} clearfix ">
            		<label for="address" class="form-label">Address</label>

            		<input type="text" name="address" value="{{ old('address', $userProfile->address ?? '') }}" class="form-control">

			            @if ($errors->has('address'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('address') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>
			</div>
			<div class="row">
			    <div class="col-md-6">
			        <div class="form-group required {{ $errors->has('city') ? ' has-error' : '' }} clearfix">
            			<label for="city" class="form-label">City</label>

            			<select name = "city" class="form-control form-select">
			                <option disabled selected>Please select an option</option>
			                @foreach($cities as $city)
			                    @if(isset($userProfile->city_id))
			                        <option value = "{{ $city->id }}" @if($userProfile->city_id == $city->id) selected @endif>
			                            {{$city->name}}
			                        </option>
			                    @elseif(old('city') != null)
			                        <option value = "{{ $city->id }}" @if($city->id == old('city')) selected @endif>
			                            {{$city->name}}
			                        </option>
			                    @else
			                        <option value = "{{ $city->id }}">
			                            {{$city->name}}
			                        </option>
			                    @endif
			                @endforeach
			            </select>

			            @if ($errors->has('city'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('city') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>

			    <div class="col-md-6">
			        <div class="form-group required {{ $errors->has('country') ? ' has-error' : '' }} clearfix">
            			<label for="country" class="form-label">Country</label>

            			<select name = "country" class="form-control form-select">
			                <option disabled selected>Please select an option</option>
			                @foreach($countries as $country)
			                    @if(isset($userProfile->country_id))
			                        <option value = "{{ $country->id }}" @if($userProfile->country_id == $country->id) selected @endif>
			                            {{$country->name}}
			                        </option>
			                    @elseif(old('country') != null)
			                        <option value = "{{ $country->id }}" @if($country->id == old('country')) selected @endif>
			                            {{$country->name}}
			                        </option>
			                    @else
			                        <option value = "{{ $country->id }}">
			                            {{$country->name}}
			                        </option>
			                    @endif
			                @endforeach
			            </select>

			            @if ($errors->has('country'))
			                <span class="help-block">
			                    <strong>{{ $errors->first('country') }}</strong>
			                </span>
			            @endif
			        </div>
			    </div>
			</div>

			<div class="form-group{{ $errors->has('user_image') ? ' has-error' : '' }} clearfix">
    			<label for="user_image" class="form-label">Image</label>
			    @if(isset($userProfile->image))
			        <div class="show-image" style="margin-bottom: 45px;">
			            <img class="custom-thumbnail selected-img" src="@if(isset($userProfile->image)) /storage/media/user/{{Auth::user()->id}}/{{$userProfile->image->filename}} @endif" class="custom-thumbnail">

			            <button type="button" class="btn btn-xs btn-delete-image" onclick="deleteImage({{Auth::user()->id }})">
			                <i class="fa fa-times fa-2x"></i>
			            </button>
			        </div>
			    @else
			         <div class="image-margin" style="margin-bottom: 45px;"> 
			            <img class="selected-img" src="">

			            <button type="button" class="btn btn-xs btn-delete-image" onclick="removeImage()">
			                <i class="fa fa-times fa-2x"></i>
			            </button>
			        </div>
			    @endif
    			<input type="file" name="user_image" class="form-control" id="input_image"  accept="image/*" />

			    @if ($errors->has('user_image'))
			        <span class="help-block">
			        <strong>{{ $errors->first('user_image') }}</strong>
			    </span>
			    @endif
			</div>

			 <div class="text-center">
			 	<button type="submit" class="btn btn-success save-btn">Update Profile</button>
			</div>
		</form>
	</div>
@endsection

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        window.savedImage = $('.selected-img').attr('src');
    });

    function removeImage()
    {
        if (confirm('Are you sure you want to delete the image?')) {
            $('#input_image').val('');
            $('.image-margin').hide();
        }
    }

    function deleteImage(userId)
    {
        // Set CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        this.selectedImage = $('.selected-img').attr('src');
        if (confirm('Are you sure you want to delete the image?')) {
            if(window.savedImage == this.selectedImage) {
                 $.ajax({
                    type     : "POST",
                    url      : `profile/delete-image/{id}`,
                    success: function(response){
                        if (response.success) {
                            $('#input_image').val('');
                            $('.show-image').hide();
                        }
                    },
                    error: function(data){
                        alert("There was some internal error while deleting the image.");
                    },
                });                    
            } else {
                $('#input_image').val('');
                $('.show-image').hide();
            }
        }
    }
</script>