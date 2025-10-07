@extends('layouts.frontend')

@section('content')
    <div class="card sell-product-panel">
        <div class="card-header text-center">
            <h3><i class="fa fa-shopping-cart" style="margin-right: 12px;"></i>Add Product Details</h3>
        </div>
        <form method="POST" action="{{ route('product-section.store') }}" enctype="multipart/form-data">
        @csrf
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
                <br>                   
                
                @include('frontend.product-section._form')
                
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

@php
    $oldWarrantyKey = old('warranty_type');
    $oldWarrantyName = $oldWarrantyKey ? ($warranty_types[$oldWarrantyKey] ?? '') : '';
@endphp

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(!empty(old('has_home_delivery')) && old('has_home_delivery') == true)
            showHomeDeliveryField();
        @else
            hideHomeDeliveryField();
            clearHomeDeliveryField();
        @endif

        $('#has_home_delivery').on('change', function () {
            if($(this).prop("checked") == true){
                showHomeDeliveryField();
            }
            else if($(this).prop("checked") == false){
                hideHomeDeliveryField();
                clearHomeDeliveryField();
            }
        });

        var oldWarrantyName = "{{ $oldWarrantyName }}".trim();
        if(oldWarrantyName != 'No Warranty') {
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