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
        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }} clearfix">
            <label for="city" class="form-label">City</label>

            <select name = "city" class="form-control form-select select2">
                <option disabled selected>Please select an option</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}"
                        @if(old('city') !== null)
                            {{ old('city') == $city->id ? 'selected' : '' }}
                        @elseif(isset($userProfile) && $userProfile->city_id == $city->id)
                            selected
                        @endif
                    >
                        {{ $city->name }}
                    </option>
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
        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }} clearfix">
            <label for="country" class="form-label">Country</label>

            <select name = "country" class="form-control form-select select2">
                <option disabled selected>Please select an option</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}"
                        @if(old('country') !== null)
                            {{ old('country') == $country->id ? 'selected' : '' }}
                        @elseif(isset($userProfile) && $userProfile->country_id == $country->id)
                            selected
                        @endif
                    >
                        {{ $country->name }}
                    </option>
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
        <div class="show-image">
            <img class="custom-thumbnail selected-img" src="@if(isset($userProfile->image)) /storage/media/user/{{$user->id}}/{{$userProfile->image->filename}} @endif" class="custom-thumbnail">

            <button type="button" class="btn btn-xs btn-delete-image" onclick="deleteImage({{ $user->id }})">
                <i class="fa fa-times fa-2x"></i>
            </button>
        </div>
    @else
         <div class="image-margin"> 
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

<br>
<div class="card-footer">
    <button type="submit" class="btn btn-success save">Update Profile</button>
</div>

