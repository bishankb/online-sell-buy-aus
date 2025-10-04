@extends('layouts.user-dashboard')

@section('frontend-style')
	<style>
		@media only screen and (max-width: 580px)  {
			.table1 td:nth-of-type(1):before { content: "Id"; }
			.table1 td:nth-of-type(2):before { content: "Title"; }
			.table1 td:nth-of-type(3):before { content: "Category"; }
			.table1 td:nth-of-type(4):before { content: "Question"; }
			.table1 td:nth-of-type(5):before { content: "Asked On"; }
			.table1 td:nth-of-type(6):before { content: "Views"; }
			.table1 td:nth-of-type(7):before { content: "Action"; }
		}
	</style>
@endsection

@section('user-dashboard-content')
	<div class="user-dashboard-body">
	    <h5 class="header-section">Your Questions</h5>
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
									<a href="{{ route('your-question.index') }}">
									All
									</a>
		                      	</li>
								@foreach($categories as $category)
								<li>
									<a href="{{ route('your-question.index', ['filter_by' => 'category', 'category' => $category->slug ]) }}">
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
		                            <a href="{{ route('your-question.index') }}">
		                            	All
		                             </a>
								</li>
								@foreach($sub_categories as $sub_category)
									<li>
										<a href="{{ route('your-question.index', ['filter_by' => 'sub_category', 'sub_category' => $sub_category->slug ]) }}">
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
		                <th>Asked On</th>
		                <th>Views</th>
		                <th class="text-center">Action</th>
	              	</tr>
	            </thead>
	            
	            <tbody>
	              	@forelse($your_questions as $your_question)
		                <tr @if($your_question->is_read == 0 && isset($your_question->answer) || $your_question->is_read == 0 && isset($your_question->answer2)) class="font-bold" @endif>
                      		<td>{{ reversePagination($your_questions, $loop) }}</td>                      
							<td>
								@if(isset($your_question->product->title))
									<a href="{{ route('product.show', $your_question->product->slug) }}" target="__blank">{{$your_question->product->title}}</a>
								@else
									<i>Deleted</i>
								@endif
							</td>
							<td>
		                        @if(isset($your_question->product->category->title))
		                          {{$your_question->product->category->title}}
		                        @else
		                          <i>Deleted</i>
		                        @endif
		                    </td>
							<td>
								{{ $your_question->question }}
							</td>
							<td>
								{{$your_question->created_at->format('d M, y')}}
							</td>
		                  	<td>
								@if($your_question->is_read == 0 && isset($your_question->answer) || $your_question->is_read == 0 && isset($your_question->answer2))
									@if(isset($your_question->answer))
										<a href="{{ route('your-question.view-reply', $your_question) }}" class="red-color">View Reply</a>
									@elseif(isset($your_question->answer2))
										<a href="{{ route('your-question.view-reply', $your_question) }}" class="red-color">View Reply</a>
									@endif
								@elseif(isset($your_question->answer) || isset($your_question->answer2))
									<a href="{{ route('your-question.view-reply', $your_question) }}" class="red-color">Viewed</a>
								@else
									No Reply
								@endif
							</td>
							<td class="text-center">
								<a class="btn btn-default btn-sm action-button" href="{{ route('your-question.edit', $your_question->question_id) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
							</td>
		                </tr>
		            @empty
		            	<tr>
							<td colspan="6">
								<div class="text-center">No data available in table</div>
							</td>
						</tr>
		            @endforelse
		        </tbody>
	        </table>
	    </div>
	    <div class="text-center" style="margin-top: 20px;">
            {{ $your_questions->appends(request()->input())->links() }}
        </div>
	</div>
@endsection
