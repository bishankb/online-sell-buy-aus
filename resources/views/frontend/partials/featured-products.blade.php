@if(count($featured_products) > 0)
	<div class="p-3 mb-3 bg-light rounded border featured-products">
		<h5 class="text-center">FEATURED PRODUCTS  </h5>
		<div id="featured-div">
			<ul id="featuredProductSlider">
				@foreach($featured_products as $featured_product)
					<li>
						<a href="{{ route('product.show', $featured_product->slug) }}">
							@if(!empty($featured_product->images->first()))
				 				<img src="/storage/media/product/{{ $featured_product->id }}/thumbnail/{{ $featured_product->images->first()->filename }}"/>
				 			@else
				 				<img src="{{ asset('frontend-template/img/no-image.jpg') }}"/>
				 			@endif
							<div class="grid-flex">
								{{ Str::limit($featured_product->title, $limit = 12, $end = '...') }}
								<p> {{ Number::currency($featured_product->price, 'AUD') }}</p>
								<span>({{ \App\Models\Product::ConditionType[$featured_product->condition_type] }})</span>
							</div>
						</a>
					</li>
				@endforeach
			</ul>
			<h5 class="text-center">
				<a href="{{ route('product.index', 'featured-products') }}">VIEW ALL</a>
				<span class="pointer"></span>
			</h5>
		</div>
	</div>
@endif


