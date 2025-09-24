@extends('layouts.backend')

@section('title')
    Roles
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Create Role</div>
                    <div class="pull-right">
                        <a href="{{ route('roles.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        @include('backend.roles._form')
                    </div>
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection