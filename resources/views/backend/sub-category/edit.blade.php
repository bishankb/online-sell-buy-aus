@extends('layouts.backend')

@section('title')
    Sub-Category
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Edit Sub Category</div>
                    <div class="pull-right">
                        <a href="{{ route('sub-categories.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                    <form method="POST" action="{{ route('sub-categories.update', $sub_category->id) }}">
                    @csrf
                    @method('PATCH')
                    <!--begin::Body-->
                    <div class="card-body">
                        @include('backend.sub-category._form')
                    </div>
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


