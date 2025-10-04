@extends('layouts.user-dashboard')

@section('user-dashboard-content')
	<div class="user-dashboard-body">
		<div class="user-dashboard-header">
		    <h5 class="header-section">Edit Query</h5>
		    <div class="pull-right">
	            <a href="{{ route('your-question.index') }}" class="btn btn-warning">Back to Listing</a>
	        </div>
	    </div>
	    <table  class="reply-table">
			<tbody>
				<tr>
					<td class="td-header">Product:</td>
					<td>
						@if(isset($your_question->product->title))
							<a href="{{ route('product.show', $your_question->product->slug) }}" class="red-color underline">
								{{ $your_question->product->title }}
							</a>
						@else
							<i>Deleted</i>
						@endif
					</td>
				</tr>
				<tr>
					<td class="td-header">Asked On:</td>
					<td>{{ $your_question->created_at->format('d M, Y') }}</td>
				</tr>
				@isset($your_question->answer)
					<tr>
						<td class="td-header">Seller Answer:</td>
						<td class="small-height">{{ $your_question->answer }}</td>
					</tr>
				@endisset

				@isset($your_question->answer2)
					<tr>
						<td class="td-header">{{env('APP_NAME')}} Answer:</td>
						<td class="small-height">{{ $your_question->answer2 }}</td>
					</tr>
				@endisset
				
			</tbody>
		</table>

		@isset($your_question->question)
			{!! Form::model($your_question, ['method' => 'patch', 'route' => ['your-question.update', $your_question->question_id], 'class' => 'reply-form']) !!}
			    <div class="form-group required {{ $errors->has('question') ? ' has-error' : '' }}">
			      	<label for="question" class="control-label">Your Query:</label>
					{!! Form::textarea('question', null, ['class' => 'form-control', 'minlength' => 2, 'maxlength' => 256, 'required' => 'required', 'id' => 'comment', 'rows' => 5, 'required' => 'required']) !!}
			      	 @if ($errors->has('question'))
		                <span class="help-block">
		                    <strong>{{ $errors->first('question') }}</strong>
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

