@extends('layouts.frontend')

@section('content')

	@include('frontend.partials.featured-products')

	<div class="shoes-grid">
		<div class="p-3 mb-3 bg-light rounded border">
			<h2>Welcome to {{ env('APP_NAME') }}</h2>
			<p class="m_text">
				<b>{{ env('APP_NAME') }}</b> ({{ env('APP_FULL_NAME') }}) is a online platform to buy, sell and exchange of goods and commodities all over the Australia. Users can post the ads of their products <b>completely free</b>. We directly connect our customers to genuine sellers.
			</p>
		</div>
		
		<div class="products">
	     	<h5 class="latest-product">LATEST PRODUCTS</h5>	
	     	<a class="view-all" href="{{ route('product.index', 'latest-products') }}">VIEW ALL<span> </span></a>
	    </div>
	    
	    <div class="product-left">
	     	<div class="row">
	     		@foreach($latest_products as $latest_product)
	   		     	<div class="col-md-3 col-sm-4 col-xs-6 main-item">
	   		     		<div class="item-grid">
		   		     		<a href="{{ route('product.show', $latest_product->slug) }}">
		   		     			@if(\App\Models\Product::ConditionType[$latest_product->condition_type] == 'Brand New')
		   		     				<div class="star"> </div>
		   		     			@endif
		   		     			@if(!empty($latest_product->images->first()))
		   		     				<img src="/storage/media/product/{{ $latest_product->id }}/thumbnail/{{ $latest_product->images->first()->filename }}" alt=" " />
		   		     			@else
		   		     				<img src="{{ asset('frontend-template/img/no-image.jpg') }}" alt=" " />
		   		     			@endif
		   		     		</a>
		   		     		<div class="grid-chain-bottom">
		   		     			<h4>
		   		     				<a href="{{ route('product.show', $latest_product->slug) }}">
		   		     					{{ Str::limit($latest_product->title, $limit = 25, $end = '...') }}
		   		     				</a>
		   		     			</h4>
	   		     				<h3>{{ Number::currency($latest_product->price, 'AUD') }}</h3>
	   		     				<h5>({{ \App\Models\Product::ConditionType[$latest_product->condition_type] }})</h5>
		   		     		</div>
		   		     	</div>
	   		     	</div>
	   		     @endforeach
	    	</div>
	     </div>

		 <div class="products">
		 	<h5 class="latest-product">POPULAR PRODUCTS</h5>	
		 	<a class="view-all" href="{{ route('product.index', 'popular-products') }}">VIEW ALL<span> </span></a>  
		 </div>
		 <div class="product-left">
		 	<div class="row">
		 		@foreach($popular_products as $popular_product)
				     	<div class="col-md-3 col-sm-4 col-xs-6 main-item">
				     		<div class="item-grid">
				     			@if(\App\Models\Product::ConditionType[$popular_product->condition_type] == 'Brand New')
				     				<span class="star"> </span>
				     			@endif
		   		     		<a href="{{ route('product.show', $popular_product->slug) }}">
		   		     			@if(!empty($popular_product->images->first()))
		   		     				<img src="/storage/media/product/{{ $popular_product->id }}/thumbnail/{{ $popular_product->images->first()->filename }}" alt=" " />
		   		     			@else
		   		     				<img src="{{ asset('frontend-template/img/no-image.jpg') }}" alt=" " />
		   		     			@endif
		   		     		</a>
		   		     		<div class="grid-chain-bottom">
		   		     			<h4>
		   		     				<a href="{{ route('product.show', $popular_product->slug) }}">
		   		     					{{ Str::limit($popular_product->title, $limit = 25, $end = '...') }}
		   		     				</a>
		   		     			</h4>
	   		     				<h3>{{ Number::currency($popular_product->price, 'AUD') }}</h3>
				     			<h5>({{ \App\Models\Product::ConditionType[$popular_product->condition_type] }})</h5>
		   		     		</div>
		   		     	</div>
				     	</div>
				     @endforeach
			 </div>
		 </div>

		@if(count($recentlyViewed_products) > 0)
			 <div class="products">
			 	<h5 class="latest-product">RECENTLY VIEWED</h5>	
	     		<a class="view-all" href="{{ route('product.index', 'recently-viewed-products') }}">VIEW ALL<span> </span></a>
			 </div>
			 <div class="product-left">
			 	<div class="row">
			 		@foreach($recentlyViewed_products as $recentlyViewed_product)
				     	<div class="col-md-3 col-sm-4 col-xs-6 main-item">
				     		<div class="item-grid">
				     			@if(\App\Models\Product::ConditionType[$recentlyViewed_product->condition_type] == 'Brand New')
		   		     				<span class="star"> </span>
		   		     			@endif
			   		     		<a href="{{ route('product.show', $recentlyViewed_product->slug) }}">
			   		     			@if(!empty($recentlyViewed_product->images->first()))
			   		     				<img src="/storage/media/product/{{ $recentlyViewed_product->id }}/thumbnail/{{ $recentlyViewed_product->images->first()->filename }}" alt=" " />
			   		     			@else
			   		     				<img src="{{ asset('frontend-template/img/no-image.jpg') }}" alt=" " />
			   		     			@endif
			   		     		</a>
			   		     		<div class="grid-chain-bottom">
			   		     			<h4>
			   		     				<a href="{{ route('product.show', $recentlyViewed_product->slug) }}">
			   		     					{{ Str::limit($recentlyViewed_product->title, $limit = 25, $end = '...') }}
			   		     				</a>
			   		     			</h4>
	   		     					<h3>{{ Number::currency($recentlyViewed_product->price, 'AUD') }}</h3>
					     			<h5>({{ \App\Models\Product::ConditionType[$recentlyViewed_product->condition_type] }})</h5>
			   		     		</div>
				     		</div>
				     	</div>
				    @endforeach
				</div>
			</div>
		@endif
	</div>   
	
	<div class="sub-cate">
		<div class=" top-nav rsidebar span_1_of_left">
			<h3 class="cate">CATEGORIES</h3>
			 <ul class="menu">
			 	@foreach($categories as $category)
					<li class="item1" style="position: relative;">
						@if(count($category->subCategories) > 0)
							<a onclick="event.preventDefault();" href="#">{{ $category->title }}
								<img class="arrow-img" src="{{ asset('frontend-template/img/arrow1.png') }}" alt=""  style="position: absolute;"/>
							</a>
						@else
							<a href="{{ route('product.index',$category->slug) }}">{{ $category->title }}</a>
						@endif
						@if(count($category->subCategories) > 0)
							<ul class="cute">
								@foreach($category->subCategories->where('home_visibility', 1) as $subCategory)
									<li class="subitem1">
										<a href="{{ route('product.index', $subCategory->slug) }}">
											<i class="fa fa-angle-right"></i>{{ $subCategory->title }}
										</a>
									</li>
								@endforeach
								<li class="subitem1">
									<a href="{{ route('product.index', $category->slug) }}">
										<i class="fa fa-angle-right"></i>See All
									</a>
								</li>
							</ul>
						@else
					        <a href="#">{{ $category->title }}</a>
					    @endif
					</li>
				@endforeach
			</ul>
		</div>
		
		<h5>
		    <a class="view-all all-product" href="{{ route('product.index', 'all-products') }}">VIEW ALL PRODUCTS<span> </span></a>
		</h5>
	</div>
@endsection


@section('frontend-script')
	<script>
		document.addEventListener("DOMContentLoaded", function() {
		    document.querySelectorAll(".menu .item1 > a").forEach(function(anchor) {
			    anchor.addEventListener("click", function(e) {
			        e.preventDefault();
			        let parent = anchor.parentElement;
			        let submenu = parent.querySelector(".cute");
			        if (!submenu) return;

			        // close all others
			        document.querySelectorAll(".menu .item1").forEach(function(item) {
			            if (item !== parent) {
			                item.classList.remove("open");
			            }
			        });

			        // toggle current
			        parent.classList.toggle("open");
			    });
			});
		});
	</script>
@endsection
