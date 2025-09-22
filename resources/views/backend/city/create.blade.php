@extends('layouts.backend')

@section('title')
    City
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Create City</div>
                    <div class="pull-right">
                        <a href="{{ route('cities.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form method="POST" action="{{ route('cities.store') }}">
                    @csrf
                    <!--begin::Body-->
                    <div class="card-body">
                        @include('backend.city._form')
                    </div>
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
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
            var totalCity = $('.city')
            var city = totalCity.last();
            var cityClone = city.clone(false);
            city[0].after(cityClone[0]);
            cityClone.find('.name').val(null);
            cityClone.find('.order').val(null);
        }

        function remove_field(){
            event.preventDefault();
            $(event.target).parent().parent().remove();
            var city = $('.city')
            if (city.length==1) {
                $('#remove-btn').hide();
            }
        }
    </script>
@endsection
