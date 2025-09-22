<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone1') ? ' has-error' : '' }} clearfix ">
            {!! Form::label('phone1', 'Phone Number', ['class' => 'control-label']) !!}

            {!! Form::text('phone1', null, ['class' => 'form-control' ]) !!}

            @if ($errors->has('phone1'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone1') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone2') ? ' has-error' : '' }} clearfix ">
            {!! Form::label('phone2', 'Secondary Phone Number', ['class' => 'control-label']) !!}

            {!! Form::text('phone2', null, ['class' => 'form-control' ]) !!}

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
            {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}

            {!! Form::text('address', null, ['class' => 'form-control' ]) !!}

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
            {!! Form::label('city', 'Select City', ['class' => 'control-label']) !!}

            <select name = "city" class="form-control">
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
        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }} clearfix">
            {!! Form::label('country', 'Select Country', ['class' => 'control-label']) !!}

            <select name = "country" class="form-control">
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
    {!! Form::label('user_image', 'Image', ['class' => 'control-label']) !!}
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
    {!! Form::file('user_image', ['class' => 'form-control', 'id' => 'input_image', 'accept' => 'image/*']) !!}

    @if ($errors->has('user_image'))
        <span class="help-block">
        <strong>{{ $errors->first('user_image') }}</strong>
    </span>
    @endif
</div>

 <div class="box-footer">
    {!! Form::submit('Update', ['class' => 'btn btn-success save']) !!}
</div>