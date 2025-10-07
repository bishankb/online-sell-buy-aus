@extends('layouts.backend')

@section('title')
    Product
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Add Product Details</div>
                    <div class="pull-right">
                        <a href="{{ route('products.addCategories') }}" class="btn btn-success">Back to Category Selection</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="callout callout-info">
                            <h4 style="font-size: 16px;">
                                Category:
                                @if(isset($sub_category)) 
                                    {{ $sub_category->category->title }} >  {{ $sub_category->title }}
                                @elseif(isset($category))
                                    {{ $category->title }}
                                @endif
                            </h4>
                        </div>
                        @include('backend.product._form')
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
            @if(!empty(old('has_home_delivery')) && old('has_home_delivery') == true)
                showHomeDeliveryField();
            @else
                hideHomeDeliveryField();
            @endif

            $('#has_home_delivery').on('change', function () {
                if($(this).prop("checked") == true){
                    showHomeDeliveryField();
                }
                else if($(this).prop("checked") == false){
                    hideHomeDeliveryField();
                    clearDeliveryField();
                }
            });

        });

        function showHomeDeliveryField() {
            $('#deliveryArea_div').show();
            $('#deliveryCharge_div').show();
        }

        function hideHomeDeliveryField() {
            $('#deliveryArea_div').hide();
            $('#deliveryCharge_div').hide();
        }

        function clearDeliveryField() {
            $('#delivery_area').val('').trigger('change');
            $('#delivery_charge').val('');
        }
    </script>
@endsection

