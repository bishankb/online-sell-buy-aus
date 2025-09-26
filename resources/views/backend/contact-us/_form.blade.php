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
        <div class="form-group {{ $errors->has('name1') ? ' has-error' : '' }} clearfix ">
            <label for="name1" class="form-label">Name 1</label>

            <input type="text" name="name1" value="{{ old('name1', $contact_us->name1 ?? '') }}" class="form-control">

            @if ($errors->has('name1'))
                <span class="help-block">
                    <strong>{{ $errors->first('name1') }}</strong>
                </span>
            @endif
        </div>
    </div>

   <div class="col-md-6">
        <div class="form-group {{ $errors->has('name2') ? ' has-error' : '' }} clearfix ">
            <label for="name2" class="form-label">Name 2</label>

            <input type="text" name="name2" value="{{ old('name2', $contact_us->name2 ?? '') }}" class="form-control">

            @if ($errors->has('name2'))
                <span class="help-block">
                    <strong>{{ $errors->first('name2') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
     <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone1') ? ' has-error' : '' }} clearfix ">
            <label for="phone1" class="form-label">Phone 1</label>

            <input type="text" name="phone1" value="{{ old('phone1', $contact_us->phone1 ?? '') }}" class="form-control">

            @if ($errors->has('phone1'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone1') }}</strong>
                </span>
            @endif
        </div>
    </div>

   <div class="col-md-6">
        <div class="form-group {{ $errors->has('phone2') ? ' has-error' : '' }} clearfix ">
            <label for="phone2" class="form-label">Phone 2</label>

            <input type="text" name="phone2" value="{{ old('phone2', $contact_us->phone2 ?? '') }}" class="form-control">

            @if ($errors->has('phone2'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone2') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('fax') ? ' has-error' : '' }} clearfix ">
            <label for="fax" class="form-label">Fax</label>

            <input type="text" name="fax" value="{{ old('fax', $contact_us->fax ?? '') }}" class="form-control">

            @if ($errors->has('fax'))
                <span class="help-block">
                    <strong>{{ $errors->first('fax') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} clearfix ">
            <label for="email" class="form-label">Email</label>

            <input type="email" name="email" value="{{ old('email', $contact_us->email ?? '') }}" class="form-control">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('facebook') ? ' has-error' : '' }} clearfix ">
            <label for="facebook" class="form-label">Facebook</label>

            <input type="text" name="facebook" value="{{ old('facebook', $contact_us->facebook ?? '') }}" class="form-control">

            @if ($errors->has('facebook'))
                <span class="help-block">
                    <strong>{{ $errors->first('facebook') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group {{ $errors->has('twitter') ? ' has-error' : '' }} clearfix ">
            <label for="twitter" class="form-label">Twitter</label>

            <input type="text" name="twitter" value="{{ old('twitter', $contact_us->twitter ?? '') }}" class="form-control">

            @if ($errors->has('twitter'))
                <span class="help-block">
                    <strong>{{ $errors->first('twitter') }}</strong>
                </span>
            @endif
        </div>
    </div>  
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group {{ $errors->has('map_embedded_link') ? ' has-error' : '' }} clearfix ">
            <label for="map_embedded_link" class="form-label">Map Link (Put width= "100%" and height = "400")</label>

            <textarea name="map_embedded_link" class="form-control" rows="5">{{ old('map_embedded_link', $contact_us->map_embedded_link ?? '') }}</textarea>

            @if ($errors->has('map_embedded_link'))
                <span class="help-block">
                    <strong>{{ $errors->first('map_embedded_link') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>