@extends('layouts.user-dashboard')

@section('frontend-style')
	<style>
		@media only screen and (max-width: 580px)  {
			.table1 td:nth-of-type(1):before { content: "Id"; }
			.table1 td:nth-of-type(2):before { content: "Title"; }
			.table1 td:nth-of-type(3):before { content: "Catgory"; }
			.table1 td:nth-of-type(4):before { content: "Images"; }
			.table1 td:nth-of-type(5):before { content: "Sold"; }
			.table1 td:nth-of-type(6):before { content: "Expired On"; }
			.table1 td:nth-of-type(7):before { content: "Featured"; }
			.table1 td:nth-of-type(8):before { content: "Actions"; }


		}

		@media only screen and (min-width: 580px)  {
			.featured-div {
				text-align: center;
			}
		}

	</style>
@endsection

@section('user-dashboard-content')
	<div class="user-dashboard-body">
	    <h5 class="header-section">Product Lists <span style="font-size: 14px">(To list your product as feature please contact us)</span></h5>
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
									<a href="{{ route('product-section.index') }}">
									All
									</a>
		                      	</li>
								@foreach($categories as $category)
								<li>
									<a href="{{ route('product-section.index', ['filter_by' => 'category', 'category' => $category->slug ]) }}">
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
		                            <a href="{{ route('product-section.index') }}">
		                            	All
		                             </a>
								</li>
								@foreach($sub_categories as $sub_category)
									<li>
										<a href="{{ route('product-section.index', ['filter_by' => 'sub_category', 'sub_category' => $sub_category->slug ]) }}">
											{{ $sub_category->title }}
										</a>
									</li>
								@endforeach
		                    </ul>
		                </div>

		                <div class="dropdown inline">
							<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
								@if(request('sold-items') != null)
									{{ request('sold-items') }}
								@else
									Filter by Sold Items
								@endif
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ route('product-section.index') }}">
										All
									</a>
								</li>
								<li>
									<a href="{{ route('product-section.index', ['filter_by' => 'sold-items', 'sold-items' => 'Sold Items']) }}">
										Sold Items
									</a>
								</li>
								<li>
									<a href="{{ route('product-section.index', ['filter_by' => 'sold-items', 'sold-items' => 'Unsold Items']) }}">
										Unsold Items
									</a>
								</li>
							</ul>
						</div>

						<div class="dropdown inline">
							<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
								@if(request('featured-items') != null)
									{{ request('featured-items') }}
								@else
									Filter by Featured Items
								@endif
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ route('product-section.index') }}">
										All
									</a>
								</li>
								<li>
									<a href="{{ route('product-section.index', ['filter_by' => 'featured-items', 'featured-items' => 'Featured Items']) }}">
										Featured Items
									</a>
								</li>
								<li>
									<a href="{{ route('product-section.index', ['filter_by' => 'featured-items', 'featured-items' => 'UnFeatured Items']) }}">
										UnFeatured Items
									</a>
								</li>
							</ul>
						</div>

		                <div class="dropdown inline">
							<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
								@if(request('expired-items') != null)
									{{ request('expired-items') }}
								@else
									Filter by Expired Items
								@endif
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ route('product-section.index') }}">
										All
									</a>
								</li>
								<li>
									<a href="{{ route('product-section.index', ['filter_by' => 'expired-items', 'expired-items' => 'Expired Items']) }}">
										Expired Items
									</a>
								</li>
								<li>
									<a href="{{ route('product-section.index', ['filter_by' => 'expired-items', 'expired-items' => 'Unexpired Items']) }}">
										Unexpired Items
									</a>
								</li>
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
		                <th>Catgory</th>
		                <th>Images</th>
		                <th>Sold</th>
		                <th>Featured</th>
                    	<th>Expired On</th>
		                <th class="text-center">Actions</th>
	              	</tr>
	            </thead>
	            
	            <tbody>
	              	@forelse($products as $product)
		                <tr>
                      		<td>{{ reversePagination($products, $loop) }}</td>                      
							<td>
								<a href="{{ route('product.show', $product->slug) }}" target="__blank">
									{{ str_limit($product->title, $limit = 18, $end = '...') }}
								</a>
							</td>
							@if(isset($product->category->title))
		                        <td>{{$product->category->title}}</td>
		                     @else
		                        <td>Deleted</td>
		                     @endif
							<td>
								<a href="{{route('product-section.addImages', $product->slug)}}" class="red-color">Manage</a>
							</td>
							
							<td>
								@if($product->is_sold == 0)
									<button class="btn btn-link red-color" data-toggle="modal" data-target="#mark-sold-modal{{$product->slug}}">Unsold</button>
								@else
									<button class="btn btn-link red-color" data-toggle="modal" data-target="#mark-unsold-modal{{$product->slug}}">Sold</button>
								@endif
							</td>

							<td>
								<div class="featured-div">
									@if($product->is_featured == 0)
										<i class="fa fa-close" style="color: #fb5b5b"></i>
									@else
										<i class="fa fa-check"  style="color: #8669a0"></i>
									@endif
								</div>
							</td>

							<td>
								@if($product->expiry_period < Carbon\Carbon::now())
									Expired
								@else
									{{$product->expiry_period->format('d M, Y')}}
								@endif  
							</td>
		                  	<td class="text-center">
			                    <a class="btn btn-default btn-sm action-button" href="{{ route('product-section.edit', ['product' => $product]) }}" data-tooltip="Edit"><i class="fa fa fa-edit"></i></a>
			                    
			                    <button class="btn btn-default btn-sm action-button" data-toggle="modal" data-target="#delete-modal{{$product->slug}}"><i class="fa fa-trash"></i></button>

			                    @if($product->expiry_period < Carbon\Carbon::now())
		                        	<button class="btn btn-default btn-sm action-button" data-toggle="modal" data-target="#renew-modal{{$product->slug}}"><i class="fa fa-refresh"></i></button>
		                        @endif
			                </td>
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
            {{ $products->appends(request()->input())->links() }}
        </div>

        @foreach($products as $product)
			<form action="{{ route('product-section.destroy', $product) }}" class="pull-xs-right5 card-link" method="POST">
				{{ csrf_field() }}
				{{method_field('DELETE')}}
				<div class="modal fade" id="delete-modal{{$product->slug}}" role="dialog">
				  @include('backend.partials.delete-modal')
				</div>
			</form>

			<form action="{{ route('product-section.markSold', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
		        {{ csrf_field() }}
		        {{method_field('PATCH')}}
		        <div class="modal fade" id="mark-sold-modal{{$product->slug}}" role="dialog">
		        	@include('backend.partials.mark-sold-modal')
		        </div>
		    </form>

		    <form action="{{ route('product-section.markSold', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
		        {{ csrf_field() }}
		        {{method_field('PATCH')}}
		        <div class="modal fade" id="mark-unsold-modal{{$product->slug}}" role="dialog">
		        	@include('backend.partials.mark-unsold-modal')
		        </div>
		    </form>

		    <form action="{{ route('product-section.renew', $product->slug) }}" class="pull-xs-right5 card-link" method="POST">
		        {{ csrf_field() }}
		        {{method_field('PATCH')}}
		        <div class="modal fade" id="renew-modal{{$product->slug}}" role="dialog">
		        	@include('backend.partials.renew-modal')
		        </div>
		    </form>
		@endforeach
	</div>
@endsection
