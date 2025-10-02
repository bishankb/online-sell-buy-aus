@extends('layouts.backend')

@section('title')
	Buyer Question
@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Col-->
        <div class="col-md-11">
            <!--begin::Quick Example-->
            <div class="card card-primary card-outline mb-4">
              <!--begin::Header-->
                <div class="card-header">
                    <div class="card-title">Edit Buyer Question</div>
                    <div class="pull-right">
                        <a href="{{ route('buyer-questions.index') }}" class="btn btn-success">Back to Listing</a>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Form-->
                <form method="POST" action="{{ route('buyer-questions.update', $buyer_question->id) }}" class="reply-form">
                    @csrf
                    @method('PATCH')
                    <!--begin::Body-->
                    <div class="card-body">
                        <table  class="reply-table">
							<tbody>
								<tr>
									<td class="td-header">Product:</td>
									<td>
										<a href="{{ route('product.show', $buyer_question->product->slug) }}" class="red-color underline">
											{{ $buyer_question->product->title }}
										</a>
									</td>
								</tr>
								<tr>
									<td class="td-header">Asked By:</td>
									<td>{{ $buyer_question->askedBy->name }}</td>
								</tr>
								<tr>
									<td class="td-header">Asked On:</td>
									<td>{{ $buyer_question->created_at->format('d M, Y') }}</td>
								</tr>
							</tbody>
						</table>

						<div class="form-group required {{ $errors->has('question') ? ' has-error' : '' }}">
						      	<label for="question" class="form-label">Buyer's query</label>

						      	<textarea name="question" id="comment" class="form-control" rows="3" minlength="2" maxlength="256" required>{{ old('question', $buyer_question->question ?? '') }}</textarea>

						      	 @if ($errors->has('question'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('question') }}</strong>
					                </span>
					            @endif
						    </div>
							@isset($buyer_question->answer)
								<div class="form-group {{ $errors->has('answer') ? ' has-error' : '' }}">
									<label for="answer" class="form-label">Seller Answer: <span class="font-13">(Clear the message to delete the seller answer)</span></label>
						      	
						      		<textarea name="answer" id="comment" class="form-control" rows="3" minlength="2" maxlength="256">{{ old('answer', $buyer_question->answer ?? '') }}</textarea>
									
							      	 @if ($errors->has('answer'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('answer') }}</strong>
						                </span>
						            @endif
							    </div>
							@endisset
							@isset($buyer_question->answer2)
							    <div class="form-group {{ $errors->has('answer2') ? ' has-error' : '' }}">
							    	<label for="answer2" class="form-label">Your Answer: <span class="font-13">(Clear the message to delete the your answer)</span></label>
						      	
						      		<textarea name="answer2" id="comment" class="form-control" rows="3" minlength="2" maxlength="256">{{ old('answer2', $buyer_question->answer2 ?? '') }}</textarea>

							      	 @if ($errors->has('answer2'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('answer2') }}</strong>
						                </span>
						            @endif
							    </div>
							@endisset
						</div>

                    </div>
                    <!--begin::Footer-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


