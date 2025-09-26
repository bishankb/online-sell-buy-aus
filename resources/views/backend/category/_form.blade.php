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

<div class="category">
    <div class="form-group required {{ $errors->has('title.*') ? ' has-error' : '' }} clearfix ">
        <div class="row">
            <label for="title" class="col-md-4 form-label">Title</label>

            <div class="col-md-6">
                <input type="text" name="title[]" value="{{ old('title[0]', $category->title ?? '') }}" class="form-control title">

                @if ($errors->has('title.*'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title.*') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-2">
                 <button style="display: none;" class="btn btn-danger mt-2" onclick="remove_field()" id="remove-btn">Remove</button>
            </div>
        </div>
    </div>

    <div class="form-group required {{ $errors->has('status.*') ? ' has-error' : '' }} clearfix">
        <div class="row">
            <label for="status" class="col-md-4 form-label">Status</label>

            <div class="col-md-6">
                <input type="hidden" name="stat[]" value="0" class="stat">

                <input type="checkbox" name="status[]" class="status" @if(!isset($category) || $category->status == 1) checked @endif>

                @if ($errors->has('status.*'))
                    <span class="help-block">
                        <strong>{{ $errors->first('status.*') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

</div>   
<br>
@if(\Route::current()->getName() != 'categories.edit')
    <div class="col-md-6">
        <button onclick="javascript:add_field()" class="btn btn-primary">Add</button>
    </div>
    <br>
@endif    

