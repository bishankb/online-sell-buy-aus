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
                    <div class="card-title">Edit Product</div>
                    <div class="pull-right">
                        <a href="{{ route('products.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form method="POST" action="{{ route('products.update', $product->slug) }}">
                    @csrf
                    @method('PATCH')
                    <!--begin::Body-->
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
                        @include('backend.product._form')
                    </div>
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success save">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
