@extends('layouts.frontend')

@section('content')
    <div class="card sell-product-panel">
        <div class="text-center">
            <h3><i class="fa fa-shopping-cart" style="margin-right: 12px;"></i>Update Your Product Information</h3>
        </div>
        <form method="POST" action="{{ route('product-section.update', $product->slug) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="card-body">
                <div class="callout callout-info">
                    <h4 style="font-size: 16px;">
                        Category: 
                        @if($product->sub_category_id != 0) 
                            {{ $product->category->title }} >  {{ $product->subCategory->title }}
                        @else
                            {{ $product->category->title }}
                        @endif
                    </h4>
                </div>
                <br>
                
                @include('frontend.product-section._form')
                
                <button type="submit" class="btn btn-success save-btn">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection

@php
    $selectedWarrantyKey = old('warranty_type', $product->warranty_type ?? '');
    $selectedWarrantyName = $selectedWarrantyKey ? ($warranty_types[$selectedWarrantyKey] ?? '') : '';
@endphp

<script>
    document.addEventListener("DOMContentLoaded", function() {

        var hasHomeDelivery = '{{ old('has_home_delivery', $product->has_home_delivery ?? 0) }}' === '1';
        if(hasHomeDelivery) {
            showHomeDeliveryField();
        } else {
            hideHomeDeliveryField();
            clearHomeDeliveryField();
        }

        $('#has_home_delivery').on('change', function () {
            if($(this).prop("checked") == true){
                showHomeDeliveryField();
            }
            else if($(this).prop("checked") == false){
                hideHomeDeliveryField();
                clearHomeDeliveryField();
            }
        });

        var initialWarrantyName = "{{ $selectedWarrantyName }}".trim();
        if(initialWarrantyName != 'No Warranty') {
            showWarrantyField();
        } else {
            hideWarrantyField();
            clearWarrantyField();
        }
        
        $('#warranty_type').on('change', function() {
            var warranty_type = $('#warranty_type option:selected').text().trim();
            if (warranty_type == 'No Warranty') {
                hideWarrantyField();
                clearWarrantyField();
            } else {
                showWarrantyField();
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

    function clearHomeDeliveryField() {
        $('#delivery_area').val('').trigger('change');
        $('#delivery_charge').val('');
    }

    function showWarrantyField() {
        $('#warrantyPeriod_div').show();
        $('#warrantyPeriodType_div').show();
    }

    function hideWarrantyField() {
        $('#warrantyPeriod_div').hide();
        $('#warrantyPeriodType_div').hide();
    }

    function clearWarrantyField() {
        $('#warranty_period').val('');
        $('#warranty_period_type').val('').trigger('change');
    }
</script>

