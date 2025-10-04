@extends('layouts.user-dashboard')

@section('user-dashboard-content')
	<div class="user-dashboard-body">
	    <div class="user-dashboard-header">
		    <h5 class="header-section">Reply</h5>
		    <div class="pull-right">
	            <a href="{{ route('buyer-question.index') }}" class="btn btn-warning">Back to Listing</a>
	        </div>
	    </div>
	    <table  class="reply-table">
			<tbody>
				<tr>
					<td class="td-header">Product:</td>
					<td>
						@if(isset($buyer_question->product->title))
							<a href="{{ route('product.show', $buyer_question->product->slug) }}" class="red-color underline">
								{{ $buyer_question->product->title }}
							</a>
						@else
							<i>Deleted</i>
						@endif
					</td>
				</tr>
				<tr>
					<td class="td-header">Asked By:</td>
					<td>
                        @if(isset($buyer_question->askedBy->name))
                          {{$buyer_question->askedBy->name}}
                        @else
                          <i>Deleted</i>
                        @endif
                    </td>
				</tr>
				<tr>
					<td class="td-header">Asked On:</td>
					<td>{{ $buyer_question->created_at->format('d M, Y') }}</td>
				</tr>
				<tr>
					<td class="td-header">Buyer's Query:</td>
					<td class="small-height">{{ $buyer_question->question }}</td>
				</tr>
				@isset($buyer_question->answer)
					<tr>
						<td class="td-header">Your Answer:</td>
						<td class="small-height">{{ $buyer_question->answer }}</td>
					</tr>
				@endisset
				@isset($buyer_question->answer2)
					<tr>
						<td class="td-header">{{env('APP_NAME')}} Answer:</td>
						<td class="small-height">{{ $buyer_question->answer2 }}</td>
					</tr>
				@endisset
			</tbody>
		</table>
		
		@if($buyer_question->answer == null)
			{!! Form::model($buyer_question, ['method' => 'patch', 'route' => ['buyer-question.sendReply', $buyer_question->question_id], 'class' => 'reply-form']) !!}
			    <div class="form-group {{ $errors->has('answer') ? ' has-error' : '' }}">
			      	<label for="answer">Your Answer:</label>
					{!! Form::textarea('answer', null, ['class' => 'form-control', 'minlength' => 2, 'maxlength' => 256, 'required' => 'required', 'id' => 'comment', 'rows' => 5]) !!}
			      	 @if ($errors->has('answer'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('answer') }}</strong>
		                </span>
		            @endif
			    </div>
			    <div class="text-center">
			    	<button type="submit" class="btn btn-success">
			    		<i class="fa fa-check"></i>Submit
			    	</button>
			    </div>
	    	{!! Form::close() !!}
	    @endif
	</div>
@endsection

