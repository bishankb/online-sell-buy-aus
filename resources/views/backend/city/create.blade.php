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
                        <h3 class="box-title">Create City</h3>
                        <div class="pull-right">
                            <a href="{{ route('cities.index') }}" class="btn btn-success">Back to Listing</a>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('cities.store') }}">
                         @csrf
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

@section('backend-script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.save').click(function () {
                var city = $('.city');
            });
            
            var bulksms = $('#remove-btn');
            if (bulksms.length == 1) {
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
