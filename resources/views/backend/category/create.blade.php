@extends('layouts.backend')

@section('title')
    Category
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Create Category</div>
                    <div class="pull-right">
                        <a href="{{ route('categories.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        @include('backend.category._form')
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
                var category = $('.category');
                category.each(function () {
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
            var totalCategory = $('.category')
            var category = totalCategory.last();
            var categoryClone = category.clone(false);
            category[0].after(categoryClone[0]);
            categoryClone.find('.title').val(null);
            categoryClone.find('.status').val(1).prop('checked', true);
        }

        function remove_field(){
            event.preventDefault();
            $(event.target).closest('.category').remove();
            var category = $('.category')
            if (category.length==1) {
                $('#remove-btn').hide();
            }
        }
    </script>
@endsection
