@extends('layouts.backend')

@section('title')
    City
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit City</h3>
                        <div class="pull-right">
                            <a href="{{ route('cities.index') }}" class="btn btn-success">Back to Listing</a>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('cities.update', $city->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="box-body">
                        
                            @include('backend.city._form')
                            
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
