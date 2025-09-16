<div class="city">
    <div class="form-group{{ $errors->has('name.*') ? ' has-error' : '' }} clearfix ">
        <label for="name" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input type="text" name="name[]" value="{{ old('name', $city->name ?? '') }}" class="form-control name">

            @if ($errors->has('name.*'))
                <span class="help-block">
                    <strong>{{ $errors->first('name.*') }}</strong>
                </span>
            @endif
        </div>
        <button class="btn btn-default" onclick="remove_field()" id="remove-btn">Remove</button>
    </div>

    <div class="form-group{{ $errors->has('order.*') ? ' has-error' : '' }} clearfix ">
        <label for="name" class="col-md-4 control-label">Order</label>

        <div class="col-md-6">
            <input type="number" name="order[]" value="{{ old('order', $city->order ?? '') }}" class="form-control order">

            @if ($errors->has('order.*'))
                <span class="help-block">
                    <strong>{{ $errors->first('order.*') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>   

@if(\Route::current()->getName() != 'cities.edit')
    <div>
        <div class="col-md-4"></div>
        <div class="col-md-6">
            <button onclick="javascript:add_field()" class="btn btn-default">Add</button>
        </div>
        <br>
    </div>
@endif    
