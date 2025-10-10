@extends('layouts.backend')

@section('title')
    Product
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Create Product</div>
                        <div class="pull-right">
                            <a href="{{ route('products.index') }}" class="btn btn-success">Back to Listing</a>
                        </div>
                    </div>
                     <!--end::Header-->
                    <!--begin::Form-->
                     <form method="POST" action="{{ route('products.redirectProductForm') }}">
                        @csrf
                        <div class="card-body">
                            <div class="callout callout-info">
                                <h4 style="font-size: 16px;">Select Category and SubCategory first</h4>
                            </div>
                        
                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }} clearfix">
                                <label for="category_id" class="form-label">Select Category</label>
                                <select name = "category" id="category_id" class="form-control form-select">
                                    <option disabled selected>Select the category</option>
                                    @foreach($categories as $category)
                                        @if(old('category') != null)
                                            <option value = "{{ $category->id }}" @if($category->id == old('category')) selected @endif>
                                                {{$category->title}}
                                            </option>
                                        @else
                                            <option value = "{{ $category->id }}">
                                                {{$category->title}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('sub_category') ? ' has-error' : '' }} clearfix">
                                <label for="sub_category" class="form-label">Select Sub-Category</label>

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
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success save">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('backend-script')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            $('#category_id').change(function(event){
                var categoryId = event.target.value;
                var subCategoryId = $('#sub_category_id');
                $.ajax({
                    url: `/admin/products/get-sub-categories/${categoryId}`,
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
        });
    </script>
@endsection