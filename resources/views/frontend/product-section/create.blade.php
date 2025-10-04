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