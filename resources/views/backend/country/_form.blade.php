<div class="country">
    <div class="form-group required {{ $errors->has('name.*') ? ' has-error' : '' }} clearfix ">
        <div class="row">
           <label for="name" class="col-md-4 form-label">Name</label>

            <div class="col-md-6">
                <input type="text" name="name[]" value="{{ old('name[0]', $country->name ?? '') }}" class="form-control name">

                @if ($errors->has('name.*'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name.*') }}</strong>
                    </span>
                @endif
            </div> 

            <div class="col-md-2">
                <button style="display: none;" class="btn btn-danger" onclick="remove_field()" id="remove-btn">Remove</button>
            </div>
        </div>
    </div>

    <div class="form-group required {{ $errors->has('order.*') ? ' has-error' : '' }} clearfix ">
        <div class="row">
            <label for="name" class="col-md-4 form-label">Order</label>

            <div class="col-md-6">
                <input type="number" name="order[]" value="{{ old('order[0]', $country->order ?? '') }}" class="form-control order">

                @if ($errors->has('order.*'))
                    <span class="help-block">
                        <strong>{{ $errors->first('order.*') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>   
<br>
@if(\Route::current()->getName() != 'countries.edit')
    <div class="col-md-6">
        <button onclick="javascript:add_field()" class="btn btn-primary">Add</button>
    </div>
    <br>
@endif    
