@extends('layouts.frontend')

@section('content') 
    <div class="card sell-product-panel">
        <div class="card-header text-center">
            <h3><i class="fa fa-shopping-cart" style="margin-right: 12px;"></i>Sell Your Product</h3>
        </div>
        <form action="{{ route('product-section.redirectProductForm') }}" method="POST">
        @csrf
            <div class="card-body">
                <div class="callout callout-info">
                    <h4 style="font-size: 16px;">Select Category and SubCategory first</h4>
                </div>
                <br>
                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }} clearfix">
                    <label for="category_id" class="form-label">Select Category</label>

                    <select name="category" id="category_id" class="form-control" required>
                        <option value="">{{ __('Select the category') }}</option>
                        @foreach($categories as $key => $value)
                            <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
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
            <div class="card-footer" style="background: #fff;">
                <button type="submit" class="btn btn-success save-btn">
                    Next
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>
@endsection

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        $('#category_id').change(function(event){
            var categoryId = event.target.value;
            var subCategoryId = $('#sub_category_id');
            $.ajax({
                url: `/product-section/get-sub-categories/${categoryId}`,
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
