@extends('layouts.frontend')

@section('content')
	<div class="card term-panel mb-3">
		<div class="card-header text-center">
        	<h1>Frequently Asked Questions</h1>
    	</div>
    	
		<div class="card-body">
	        <h5>Please contact us if you have any queries !!!</h5><br>

	        @if(count($faqs) > 0)
	            @foreach($faqs as $faq)
	                <div class="card faq-body-panel mb-2">
	                    <div class="card-header p-2" style="cursor: pointer;"
	                         data-bs-toggle="collapse" 
	                         data-bs-target="#question{{ $loop->iteration }}" 
	                         aria-expanded="false" 
	                         aria-controls="question{{ $loop->iteration }}">
	                        <h5 class="mb-0">
	                            <a href="javascript:void(0)" class="faq-anchor text-decoration-none">Q: {{ $faq->faq }}</a>
	                        	<span class="faq-arrow" style="float: right;">&#9662;</span>
	                        </h5>
	                    </div>

	                    <div id="question{{ $loop->iteration }}" class="collapse">
	                        <div class="card-body">
	                            <h5>
	                                <span class="badge bg-success answer">Answer</span>
	                            </h5><br>

	                            <div class="faq-answer">
	                                {!! $faq->answer !!}
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            @endforeach

	            <div class="card-footer clearfix d-flex justify-content-center">
	            	{{ $faqs->links('vendor.pagination.bootstrap-4') }}
	          	</div>
	        @else
	            <div class="alert alert-info" role="alert">
	                <a href="#" class="alert-link">FAQs will be uploaded soon!!!!</a>
	            </div>
	        @endif
	    </div>
	</div>
@endsection
