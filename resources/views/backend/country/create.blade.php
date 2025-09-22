@extends('layouts.backend')

@section('title')
    Country
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Create Country</div>
                    <div class="pull-right">
                        <a href="{{ route('countries.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form method="POST" action="{{ route('countries.store') }}">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        @include('backend.country._form')
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

@section('backend-script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {            
            var removeButton = $('#remove-btn');
            if (removeButton.length == 1) {
                $('#remove-btn').hide();
            }
        });

        function add_field() {
            event.preventDefault()
            $('#remove-btn').show();
            var totalCountry = $('.country')
            var country = totalCountry.last();
            var countryClone = country.clone(false);
            country[0].after(countryClone[0]);
            countryClone.find('.name').val(null);
            countryClone.find('.order').val(null);
        }

        function remove_field(){
            event.preventDefault();
            $(event.target).parent().parent().remove();
            var country = $('.country')
            if (country.length==1) {
                $('#remove-btn').hide();
            }
        }
    </script>
@endsection
