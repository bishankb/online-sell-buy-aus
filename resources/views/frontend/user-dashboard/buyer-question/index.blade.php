@extends('layouts.user-dashboard')

@section('frontend-style')
	<style>
		@media only screen and (max-width: 580px)  {
			.table1 td:nth-of-type(1):before { content: "Id"; }
			.table1 td:nth-of-type(2):before { content: "Title"; }
			.table1 td:nth-of-type(3):before { content: "Category"; }
			.table1 td:nth-of-type(4):before { content: "Question"; }
			.table1 td:nth-of-type(5):before { content: "Asked By"; }
			.table1 td:nth-of-type(6):before { content: "Asked On"; }
			.table1 td:nth-of-type(7):before { content: "Views"; }
			.table1 td:nth-of-type(8):before { content: "Action"; }
		}
	</style>
@endsection

@section('user-dashboard-content')
	<div class="user-dashboard-body">
	    <h5 class="header-section">Buyer Questions</h5>
	    <div class="table-responsive customResp">
	    	<table class="table1 table-bordered table-striped">
	            <thead>
	            	<div class="filter">
		                <label>Filters: </label>
		                <div class="dropdown inline">
		                 	<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
			                	@if(request('category') != null)
			                    	{{ request('category') }}
			                  	@else
			                    	Filter by Categories
			                  	@endif
			                  	<span class="caret"></span>
		              		</button>
		                  	<ul class="dropdown-menu scrollable-menu">
		                      	<li>
									<a href="{{ route('buyer-question.index') }}">
									All
									</a>
		                      	</li>
								@foreach($categories as $category)
								<li>
									<a href="{{ route('buyer-question.index', ['filter_by' => 'category', 'category' => $category->slug ]) }}">
										{{ $category->title }}
									</a>
								</li>
								@endforeach
		                  	</ul>
		                </div>

		                <div class="dropdown inline">
		                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
			                    @if(request('sub_category') != null)
			                        {{ request('sub_category') }}
			                    @else
			                        Filter by Sub-Categories
			                    @endif
			                    <span class="caret"></span>
			                </button>
		                    <ul class="dropdown-menu scrollable-menu">
		                        <li>
		                            <a href="{{ route('buyer-question.index') }}">
		                            	All
		                             </a>
								</li>
								@foreach($sub_categories as $sub_category)
									<li>
										<a href="{{ route('buyer-question.index', ['filter_by' => 'sub_category', 'sub_category' => $sub_category->slug ]) }}">
											{{ $sub_category->title }}
										</a>
									</li>
								@endforeach
		                    </ul>
		                </div>
		            </div>
	            	<div class="table-search">
	                    <form>
							<div class="input-group input-group-sm">
								<input type="text" name="search-item" value="{{ request('search-item') }}" class="form-control pull-right" placeholder="Search">
								<div class="input-group-btn">
								  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
	                    </form>
	                </div>
	              	<tr>
		                <th>#</th>
		                <th>Title</th>
		                <th>Category</th>
		                <th>Question</th>
		                <th>Asked By</th>
		                <th>Asked On</th>
		                <th>Reply</th>
		                <th class="text-center">Action</th>
	              	</tr>
	            </thead>
	            
	            <tbody>
	              	@forelse($buyer_questions as $buyer_question)
		                <tr @if($buyer_question->answer == null) class="font-bold" @endif>
                      		<td>{{ reversePagination($buyer_questions, $loop) }}</td>                      
							<td>
		                        @if(isset($buyer_question->product->title))
		                          <a href="{{ route('product.show', $buyer_question->product->slug) }}" target="__blank">{{$buyer_question->product->title}}</a>
		                        @else
		                          <i>Deleted</i>
		                        @endif
		                    </td>
							<td>
		                        @if(isset($buyer_question->product->category->title))
		                          {{$buyer_question->product->category->title}}
		                        @else
		                          <i>Deleted</i>
		                        @endif
		                    </td>
							<td>
								{{ $buyer_question->question }}
							</td>
							<td>
		                        @if(isset($buyer_question->askedBy->name))
		                          {{$buyer_question->askedBy->name}}
		                        @else
		                          <i>Deleted</i>
		                        @endif
		                    </td>
							<td>
								{{$buyer_question->created_at->format('d M, y')}}
							</td>
		                  	<td>
								@if($buyer_question->answer == null)
									<a href="{{ route('buyer-question.reply', $buyer_question->question_id) }}" class="red-color">Reply</a>
								@else
									<a href="{{ route('buyer-question.reply', $buyer_question->question_id) }}" class="red-color">Replied</a>
								@endif
							</td>
							@isset($buyer_question->answer)
								<td class="text-center">
									<a class="btn btn-default btn-sm action-button" href="{{ route('buyer-question.edit', $buyer_question->question_id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
								</td>
							@endif
		                </tr>
		            @empty
		            	<tr>
							<td colspan="8">
								<div class="text-center">No data available in table</div>
							</td>
						</tr>
		            @endforelse
		        </tbody>
	        </table>
	    </div>
	    <div class="text-center" style="margin-top: 20px;">
            {{ $buyer_questions->appends(request()->input())->links() }}
        </div>
	</div>
@endsection
