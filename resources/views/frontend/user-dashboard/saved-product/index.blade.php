@extends('layouts.user-dashboard')

@section('frontend-style')
	<style>
		@media only screen and (max-width: 580px)  {
			.table1 td:nth-of-type(1):before { content: "Id"; }
			.table1 td:nth-of-type(2):before { content: "Title"; }
			.table1 td:nth-of-type(3):before { content: "Category"; }
			.table1 td:nth-of-type(4):before { content: "Action"; }
		}
	</style>
@endsection

@section('user-dashboard-content')
	<div class="user-dashboard-body">
	    <h5 class="header-section">Saved Products</h5>
	    <div class="table-responsive customResp">
	    	<table class="table1 table-bordered table-striped">
	            <thead>
	            	<div class="filter">
                  		<label>&nbsp Filters: </label>
		                <div class="dropdown inline">
		                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
		                      @if(request('category') != null)
		                        {{ request('category') }}
		                      @else
		                        Filter by Categories
		                      @endif
		                    </button>
		                    <ul class="dropdown-menu scrollable-menu">
		                        <li>
		                            <a class="dropdown-item" href="{{ route('saved-product.index') }}">
		                             All
		                            </a>
		                        </li>
		                        @foreach($categories as $category)
		                          <li>
		                            <a class="dropdown-item" href="{{ route('saved-product.index', ['filter_by' => 'category', 'category' => $category->slug ]) }}">
		                              {{ $category->title }}
		                            </a>
		                          </li>
		                        @endforeach
		                    </ul>
		                 </div>

		                <div class="dropdown inline">
		                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
		                      @if(request('sub_category') != null)
		                        {{ request('sub_category') }}
		                      @else
		                        Filter by Sub-Categories
		                      @endif
		                    </button>
		                    <ul class="dropdown-menu scrollable-menu">
		                        <li>
		                            <a class="dropdown-item" href="{{ route('saved-product.index') }}">
		                             All
		                            </a>
		                        </li>
		                        @foreach($sub_categories as $sub_category)
		                          <li>
		                            <a class="dropdown-item" href="{{ route('saved-product.index', ['filter_by' => 'sub_category', 'sub_category' => $sub_category->slug ]) }}">
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
		                <th class="text-center">Actions</th>
	              	</tr>
	            </thead>
	            
	            <tbody>
	              	@forelse($saved_products as $saved_product)
		                <tr>
                      		<td>{{ reversePagination($saved_products, $loop) }}</td>                      
							<td>
								<a href="{{ route('product.show', $saved_product->slug) }}" target="__blank">
									{{ Str::limit($saved_product->title, $limit = 18, $end = '...') }}
								</a>
							</td>
							@if(isset($saved_product->category->title))
		                        <td>{{$saved_product->category->title}}</td>
		                     @else
		                        <td>Deleted</td>
		                     @endif
		                  	<td class="text-center">
			                    <button class="btn btn-sm action-button" data-bs-toggle="modal" data-bs-target="#unsaved-product-modal{{$saved_product->slug}}">
			                    	<i class="fa fa-bookmark-o" style="color: #d88d28;"></i>
			                    </button>
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
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
        	{{ $saved_products->links('vendor.pagination.bootstrap-4') }}
        </div>
        @foreach($saved_products as $saved_product)
			<form action="{{ route('unsaved.product', $saved_product->slug) }}" class="pull-xs-right5 card-link" method="POST">
				{{ csrf_field() }}
				<div class="modal fade" id="unsaved-product-modal{{$saved_product->slug}}" role="dialog">
				  @include('backend.partials.unsave-product-modal')
				</div>
		    </form>
		@endforeach
	</div>
@endsection
