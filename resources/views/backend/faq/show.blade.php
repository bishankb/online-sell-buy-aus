@extends('layouts.jobs-backend')

@section('title')
    Job Faqs
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="pull-right">
                        <a href="{{ route('faq.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>FAQ:</strong> {{ $faq->faq }}
                        </li>
                        <li class="list-group-item">
                            <strong>Answer:</strong> {!! $faq->answer !!}
                        </li>
                        <li class="list-group-item">
                            <strong>Publish</strong><br>{{ $faq->publish_faq == 1 ? 'Yes' : 'No' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

