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
                        <h3 class="box-title">Add Product Details</h3>
                        <div class="pull-right">
                            <a href="{{ route('products.addCategories') }}" class="btn btn-success">Back to Category Selection</a>
                        </div>
                    </div>
                    {!! Form::model(null, ['method' => 'post', 'route' => ['products.store'], 'files' => 'true']) !!}
                        <div class="box-body">
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
                        <div class="box-footer">
                            {!! Form::submit('Next', ['class' => 'btn btn-success save']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection