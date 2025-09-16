@extends('layouts.backend')

@section('title')
    Country
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Country</h3>
                        <div class="pull-right">
                            <a href="{{ route('countries.index') }}" class="btn btn-success">Back to Listing</a>
                        </div>
                    </div>
                    {!! Form::model(null, ['method' => 'post', 'route' => ['countries.store']]) !!}
                        <div class="box-body">
                        
                            @include('backend.country._form')
                            
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

@section('backend-script')
    <script>
        $(document).ready(function () {
            $('.save').click(function () {
                var country = $('.country');
            });
            
            var bulksms = $('#remove-btn');
            if (bulksms.length == 1) {
                $('#remove-btn').hide();
            }
        })
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
