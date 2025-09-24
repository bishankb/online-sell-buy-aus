@extends('layouts.backend')

@section('title')
    Sub-Category
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Sub Category</h3>
                        <div class="pull-right">
                            <a href="{{ route('sub-categories.index') }}" class="btn btn-success">Back to Listing</a>
                        </div>
                    </div>
                    {!! Form::model($sub_category, ['method' => 'patch', 'route' => ['sub-categories.update', $sub_category->id]]) !!}
                        <div class="box-body">
                        
                            @include('backend.sub-category._form')
                            
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
