@extends('layouts.frontend')

@section('content')
    <div class="panel panel-default sell-product-panel">
        <div class="text-center">
            <h3><i class="fa fa-shopping-cart" style="margin-right: 12px;"></i>Update Your Product Information</h3>
        </div>
            {!! Form::model($product, ['method' => 'patch', 'route' => ['product-section.update', $product], 'files' => 'true']) !!}
                <div class="panel-body">
                    <h5><strong>Note: </strong>
                        Category: 
                        @if($product->sub_category_id != 0) 
                            {{ $product->category->title }} >  {{ $product->subCategory->title }}
                        @else
                            {{ $product->category->title }}
                        @endif
                    </h5>                        
                    
                    @include('frontend.product-section._form')
                    
                    <button type="submit" class="btn btn-success save-btn">
                        Update
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection