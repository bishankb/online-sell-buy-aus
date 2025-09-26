@extends('layouts.backend')

@section('title')
    Product
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Product</h3>
                        <div class="pull-right">
                            <a href="{{ route('products.index') }}" class="btn btn-success">Back to Listing</a>
                        </div>
                    </div>
                    {!! Form::model(null, ['method' => 'post', 'route' => ['products.redirectProductForm']]) !!}
                        <div class="box-body">
                            <div class="callout callout-info">
                                <h4 style="font-size: 16px;">Select Category and SubCategory first</h4>
                            </div>
                        
                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }} clearfix">
                                {!! Form::label('category_id', 'Select Category', ['class' => 'control-label']) !!}

                                    {!! Form::select('category', $categories, null,['id'=>'category_id', 'class' => 'form-control', 'placeholder' => 'Select the category']) !!}

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('sub_category') ? ' has-error' : '' }} clearfix">
                                {!! Form::label('sub_category', 'Select Sub-Category', ['class' => 'control-label']) !!}

                                    <select name="sub_category" id="sub_category_id" class="form-control" placeholder="Select the category first">
                                        <option value>Select the category first</option>
                                    </select>

                                @if ($errors->has('sub_category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_category') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                        <div class="box-footer">
                            {!! Form::submit('Next', ['class' => 'btn btn-success save']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('backend-script')
    <script type="text/javascript">
        $('#category_id').change(function(event){
            var categoryId = event.target.value;
            var subCategoryId = $('#sub_category_id');

            $.ajax({
                url: "{{ route('products.getSubCategories', '') }}/" + categoryId,
                success: function (response) {
                    subCategoryId.empty();
                    if (response.sub_categories.length > 0) {
                        $.each(response.sub_categories, function (index, element) {
                            subCategoryId.append("<option value='" + element.id + "'>" + element.title + " </option>")
                        })
                    }
                    else {
                        subCategoryId.append("<option value=''>No Sub Category in this category</option>")
                    }
                },
                error: function(data){
                  alert("There was some internal error while showing the sub categories.");
                  window.location.reload(); 
                },
            });
        });
    </script>
@endsection