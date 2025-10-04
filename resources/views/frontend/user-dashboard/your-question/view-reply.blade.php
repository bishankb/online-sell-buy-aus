@extends('layouts.user-dashboard')

@section('user-dashboard-content')
	<div class="user-dashboard-body">
		<div class="user-dashboard-header">
		    <h5 class="header-section">Seller Reply</h5>
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
				<tr>
					<td class="td-header">Your Query:</td>
					<td class="small-height">{{ $your_question->question }}</td>
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
	</div>
@endsection

