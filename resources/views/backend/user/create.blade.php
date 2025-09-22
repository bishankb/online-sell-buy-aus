@extends('layouts.backend')

@section('title')
  User
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Create User</div>
                    <div class="pull-right">
                        <a href="{{ route('users.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        @include('backend.user._addForm')
                    </div>
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success save">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
