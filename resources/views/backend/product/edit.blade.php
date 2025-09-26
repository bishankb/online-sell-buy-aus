@extends('layouts.backend')

@section('title')
    Product
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Product</h3>
                        <div class="pull-right">
                            <a href="{{ route('products.index') }}" class="btn btn-success">Back to Listing</a>
                        </div>
                    </div>
                    {!! Form::model($product, ['method' => 'patch', 'route' => ['products.update', $product]]) !!}
                        <div class="box-body">
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
                        <div class="box-footer">
                            {!! Form::submit('Save', ['class' => 'btn btn-success save']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
