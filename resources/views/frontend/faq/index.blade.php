@extends('layouts.frontend')

@section('content')
	<div class="page-grid panel panel-default">
		<div class="panel-body">
			<h2>Frequently Asked Questions</h2>
			<p>Please contact us if you have any querries !!!</p><br>
	        @if(count($faqs) > 0)
	            @foreach($faqs as $faq)
	                <div class="panel panel-default faq-body-panel">
	                    <div class="panel-heading collapsed" data-toggle="collapse" data-target="#question{{ $loop->iteration }}" style="">
	                        <h4 class="panel-title">
	                            <a href="javascript:void(0)" class="faq-anchor">Q: {{ $faq->faq }}</a>
	                        </h4>

	                    </div>
	                    <div id="question{{ $loop->iteration }}" class="answer-body panel-collapse collapse">
	                        <div class="panel-body">
	                            <h5>
	                            	<span class="label label-success answer">Answer</span>
	                            </h5><br>

	                            <div class="faq-answer">
	                                {!! $faq->answer !!}
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            @endforeach

	            <div class="text-center">
					{{ $faqs->appends(request()->input())->links() }}
				</div>
	        @else
	            <div class="alert alert-info" role="alert">
	                <a href="#" class="alert-link">FAQs will be uploaded soon!!!!</a>
	            </div>
	        @endif
	    </div>
	</div>
@endsection
