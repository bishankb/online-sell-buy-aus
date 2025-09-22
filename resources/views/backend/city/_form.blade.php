<div class="city">
    <div class="form-group{{ $errors->has('name.*') ? ' has-error' : '' }} clearfix ">
        <label for="name" class="form-label">Name</label>

        <div class="col-md-6">
            <input type="text" name="name[]" value="{{ old('name[0]', $city->name ?? '') }}" class="form-control name">

            @if ($errors->has('name.*'))
                <span class="help-block">
                    <strong>{{ $errors->first('name.*') }}</strong>
                </span>
            @endif
        </div>
        <button style="display: none;" class="btn btn-danger mt-2" onclick="remove_field()" id="remove-btn">Remove</button>
    </div>

    <div class="form-group{{ $errors->has('order.*') ? ' has-error' : '' }} clearfix ">
        <label for="name" class="form-label">Order</label>

        <div class="col-md-6">
            <input type="number" name="order[]" value="{{ old('order[0]', $city->order ?? '') }}" class="form-control order">

            @if ($errors->has('order.*'))
                <span class="help-block">
                    <strong>{{ $errors->first('order.*') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>   
<br>
@if(\Route::current()->getName() != 'cities.edit')
    <div class="col-md-6">
        <button onclick="javascript:add_field()" class="btn btn-primary">Add</button>
    </div>
    <br>
@endif    
