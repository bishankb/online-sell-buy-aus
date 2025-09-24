@extends('layouts.backend')

@section('title')
    Sub-Category
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Create Sub Category</div>
                    <div class="pull-right">
                        <a href="{{ route('sub-categories.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form method="POST" action="{{ route('sub-categories.store') }}">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        @include('backend.sub-category._form')
                    </div>
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('backend-script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.save').click(function () {
                var subCategory = $('.sub-category');
                subCategory.each(function () {
                    if ($(this).find('.status').prop('checked') == false) {
                        $(this).find('.stat').val(0)
                    } else {
                        $(this).find('.stat').val(1)
                    }
                })
            });
            
            var bulksms = $('#remove-btn');
            if (bulksms.length == 1) {
                $('#remove-btn').hide();
            }
        })
        function add_field() {
            event.preventDefault()
            $('#remove-btn').show();
            var totalSubCategory = $('.sub-category');
            var subCategory = totalSubCategory.last();
            var subCategoryClone = subCategory.clone(false);
            subCategory[0].after(subCategoryClone[0]);
            subCategoryClone.find('.title').val(null);
            subCategoryClone.find('.status').val(1).prop('checked', true);
        }

        function remove_field(){
            event.preventDefault();
            $(event.target).closest('.sub-category').remove();
            var subCategory = $('.sub-category')
            if (subCategory.length==1) {
                $('#remove-btn').hide();
            }
        }
    </script>
@endsections
