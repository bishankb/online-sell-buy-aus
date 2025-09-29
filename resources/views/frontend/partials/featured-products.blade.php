@section('frontend-style')
	<style type="text/css">
		#featured-div {
			visibility: hidden;
			height: 156px;
		}
	</style>
@endsection

@if(count($featured_products) > 0)
	<div class="well featured-products">
		<h4 class="text-center">FEATURED PRODUCTS  </h4>
		<div id="featured-div">
			<ul id="featuredProductSlider">
				@foreach($featured_products as $featured_product)
					<li>
						<a href="#">
							@if(!empty($featured_product->images->first()))
				 				<img src="/storage/media/product/{{ $featured_product->id }}/thumbnail/{{ $featured_product->images->first()->filename }}"/>
				 			@else
				 				<img src="{{ asset('images/no-image.jpg') }}"/>
				 			@endif
							<div class="grid-flex">
								{{ Str::limit($featured_product->title, $limit = 12, $end = '...') }}
								<p>Rs. {{ nepaliCurrencyFormat($featured_product->price) }}</p>
								<span>({{ \App\Models\Product::ConditionType[$featured_product->condition_type] }})</span>
							</div>
						</a>
					</li>
				@endforeach
			</ul>
			<h5 class="text-center">
				<a href="#">VIEW ALL</a>
				<span class="pointer"></span>
			</h5>
		</div>
	</div>
@endisset

@if(\Route::current()->getName() != 'product.show')
	 @section('frontend-script')
		<script async type="text/javascript">
			$(window).load(function() {
			    $("#featured-div").css("visibility", "visible");
				$("#featuredProductSlider").flexisel({
					visibleItems: 4,
		            itemsToScroll: {{ config('product.feature_item_scroll') }},
		            animationSpeed: 800,
		            infinite: true,
		            navigationTargetSelector: null,
		            autoPlay: {
		                enable: true,
		                interval: 3000,
		                pauseOnHover: true
		            },
		            responsiveBreakpoints: { 
		                portrait: { 
		                    changePoint:480,
		                    visibleItems: 1,
		                    itemsToScroll: 1
		                }, 
		                landscape: { 
		                    changePoint:640,
		                    visibleItems: 2,
		                    itemsToScroll: 2
		                },
		                tablet: { 
		                    changePoint:769,
		                    visibleItems: 3,
		                    itemsToScroll: 3
		                }
		            },
			    });
			});
		</script>
	@endsection
@endif