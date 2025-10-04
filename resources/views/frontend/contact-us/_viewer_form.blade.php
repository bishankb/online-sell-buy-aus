<div class="form-group required {{ $errors->has('name') ? ' has-error' : '' }} clearfix ">
    <input type="text" name="name" value="{{ old('name') }}" class="form-control input-lg" minlength="2" required placeholder="Enter your name">

    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group required {{ $errors->has('email') ? ' has-error' : '' }} clearfix ">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control input-lg" minlength="2" required placeholder="Enter your email">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group required {{ $errors->has('phone') ? ' has-error' : '' }} clearfix ">
            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control input-lg" minlength="2" maxlength="20" required placeholder="Enter your phone number">

            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group required {{ $errors->has('subject') ? ' has-error' : '' }} clearfix ">
            <input type="text" name="subject" value="{{ old('subject') }}" class="form-control input-lg" minlength="2" maxlength="256" required placeholder="Enter subject">

            @if ($errors->has('subject'))
                <span class="help-block">
                    <strong>{{ $errors->first('subject') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group required {{ $errors->has('message') ? ' has-error' : '' }} clearfix ">
    <textarea name="message" class="form-control" rows="3" minlength="2" maxlength="256" required placeholder="Enter your message">{{ old('message') }}</textarea>

    @if ($errors->has('message'))
        <span class="help-block">
            <strong>{{ $errors->first('message') }}</strong>
        </span>
    @endif
</div>

