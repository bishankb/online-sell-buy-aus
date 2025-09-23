<div class="row">
    <div class="col-md-6">
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

    <div class="col-md-6">
        <div class="form-group required {{ $errors->has('password_confirmation') ? ' has-error' : '' }} clearfix ">
            <label for="password_confirmation" class="form-label">Confirm Password</label>

            <input type="password" name="password_confirmation" class="form-control" required="required">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
 <div class="card-footer">
    <button type="submit" class="btn btn-success save">Change</button>
</div>