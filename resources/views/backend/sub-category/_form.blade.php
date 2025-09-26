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

<div class="sub-category">
        <div class="form-group required {{ $errors->has('category_id.*') ? ' has-error' : '' }} clearfix">
            <div class="row">
                <label for="category_id" class="col-md-4 form-label">Select Category</label>

                <div class="col-md-6">
                    <select name = "category_id[]" class="form-control form-select" id="category_id">
                        <option value="">Select the category</option>
                        @foreach($categories as $category)
                            @if(isset($sub_category->category_id))
                                <option value = "{{ $category->id }}" @if($sub_category->category_id == $category->id) selected @endif>
                                    {{$category->title}}
                                </option>
                            @elseif(old('category_id') != null)
                                <option value = "{{ $category->id }}" @if($category->id == old('category_id')) selected @endif>
                                    {{$category->title}}
                                </option>
                            @else
                                <option value = "{{ $category->id }}">
                                    {{$category->title}}
                                </option>
                            @endif
                        @endforeach
                    </select>

                    @if ($errors->has('category_id.*'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category_id.*') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

    <div class="form-group required {{ $errors->has('title.*') ? ' has-error' : '' }} clearfix ">
        <div class="row">
            <label for="title" class="col-md-4 form-label">Title</label>

            <div class="col-md-6">
                <input type="text" name="title[]" value="{{ old('title[0]', $sub_category->title ?? '') }}" class="form-control title">

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

                <input type="checkbox" name="status[]" value="0" class="status" checked="checked">

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
@if(\Route::current()->getName() != 'sub-categories.edit')
    <div class="col-md-6">
        <button onclick="javascript:add_field()" class="btn btn-primary">Add</button>
    </div>
    <br>
@endif   
