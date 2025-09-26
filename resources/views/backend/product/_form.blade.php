<div class="form-group required {{ $errors->has('title') ? ' has-error' : '' }} clearfix ">
    <label for="title" class="form-label">Title</label>
    
    <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}" class="form-control" required>

    @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>

<div class="form-group required {{ $errors->has('description') ? ' has-error' : '' }} clearfix">
    <label for="description" class="form-label">Description</label>

    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $product->description ?? '') }}</textarea>

    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group required {{ $errors->has('price') ? ' has-error' : '' }} clearfix ">
            <label for="price" class="form-label">Price ($)</label>

            <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" class="form-control" required>

            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group required {{ $errors->has('is_negotiable') ? ' has-error' : '' }} clearfix ">
            <label for="is_negotiable" class="form-label">Negotiable</label>

            <div>
                <label class="switch">
                    @if(isset($product->is_negotiable))
                        <input type="checkbox" name="is_negotiable" @if($product->is_negotiable == 1) checked @endif>
                    @else
                        <input type="checkbox" name="is_negotiable">
                    @endif
                    <span class="slider round"></span>
                </label>
            </div>
            
            @if ($errors->has('is_negotiable'))
                <span class="help-block">
                    <strong>{{ $errors->first('is_negotiable') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="form-group required {{ $errors->has('condition_type') ? ' has-error' : '' }} clearfix">
    <label for="condition_type" class="form-label">Condition</label>

    <select name = "condition_type" id="condition_type" class="form-control form-select" required>
        <option disabled selected>Select the condition type</option>
        @foreach($condition_types as $key => $condition_type)
            @if(isset($product->condition_type))
                <option value = "{{ $key }}" @if($product->condition_type == $key) selected @endif>
                    {{$condition_type}}
                </option>
            @elseif(old('condition_type') != null)
                <option value = "{{ $key }}" @if($key == old('condition_type')) selected @endif>
                    {{$condition_type}}
                </option>
            @else
                <option value = "{{ $key }}">
                    {{$condition_type}}
                </option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('condition_type'))
        <span class="help-block">
            <strong>{{ $errors->first('condition_type') }}</strong>
        </span>
    @endif
</div>


<div class="form-group required {{ $errors->has('expiry_period') ? ' has-error' : '' }} clearfix">
    <label for="expiry_period" class="form-label">Product Expiry Period</label>

    <select name = "expiry_period" id="expiry_period" class="form-control form-select" required>
        <option disabled selected>Select the expiry period</option>
        @foreach($expiry_periods as $key => $expiry_period)
            @if(isset($product->expiry_period_type))
                <option value = "{{ $key }}" @if($product->expiry_period_type == $key) selected @endif>
                    {{$expiry_period}}
                </option>
            @elseif(old('expiry_period') != null)
                <option value = "{{ $key }}" @if($key == old('expiry_period')) selected @endif>
                    {{$expiry_period}}
                </option>
            @else
                <option value = "{{ $key }}">
                    {{$expiry_period}}
                </option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('expiry_period'))
        <span class="help-block">
            <strong>{{ $errors->first('expiry_period') }}</strong>
        </span>
    @endif
</div>

<!--  Automobiles Only -->
@if(isset($sub_category) && $sub_category->category->slug == 'automobiles' || isset($product) && $product->category->slug == 'automobiles')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group required {{ $errors->has('make_year') ? ' has-error' : '' }} clearfix ">
                <label for="make_year" class="form-label">Make Year</label>

                <input type="number" name="make_year" value="{{ old('make_year', $product->make_year ?? '') }}" class="form-control" required>

                @if ($errors->has('make_year'))
                    <span class="help-block">
                        <strong>{{ $errors->first('make_year') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('kilometer_run') ? ' has-error' : '' }} clearfix ">
                <label for="kilometer_run" class="form-label">Kilometer Run</label>

                <input type="number" name="kilometer_run" value="{{ old('kilometer_run', $product->kilometer_run ?? '') }}" class="form-control">

                @if ($errors->has('kilometer_run'))
                    <span class="help-block">
                        <strong>{{ $errors->first('kilometer_run') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
           <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }} clearfix ">
                <label for="color" class="form-label">Color</label>

                <input type="text" name="color" value="{{ old('color', $product->color ?? '') }}" class="form-control">

                @if ($errors->has('color'))
                    <span class="help-block">
                        <strong>{{ $errors->first('color') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
@endif

<!-- Automobiles & Computer-Equipments & Electronics & Fashion-Wear & Mobile-Accessories -->
@if(isset($sub_category) && $sub_category->category->slug == 'automobiles' ||
        isset($sub_category) && $sub_category->category->slug == 'computer-equipments' ||
        isset($sub_category) && $sub_category->category->slug == 'electronics' ||
        isset($sub_category) && $sub_category->category->slug == 'fashion-wear' ||
        isset($sub_category) && $sub_category->category->slug == 'mobile-accessories' ||
        isset($product) && $product->category->slug == 'automobiles' ||
        isset($product) && $product->category->slug == 'computer-equipments' ||
        isset($product) && $product->category->slug == 'electronics' ||
        isset($product) && $product->category->slug == 'fashion-wear'||
        isset($product) && $product->category->slug == 'mobile-accessories'
    )
    <div class="form-group {{ $errors->has('manufacturer') ? ' has-error' : '' }} clearfix ">
        <label for="manufacturer" class="form-label">Manufacturer</label>
        
        <input type="text" name="manufacturer" value="{{ old('manufacturer', $product->manufacturer ?? '') }}" class="form-control">

        @if ($errors->has('manufacturer'))
            <span class="help-block">
                <strong>{{ $errors->first('manufacturer') }}</strong>
            </span>
        @endif
    </div>
@endif

<!-- Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games -->
@if(isset($sub_category) && $sub_category->category->slug == 'automobiles' ||
        isset($sub_category) && $sub_category->category->slug == 'beauty-health' ||
        isset($sub_category) && $sub_category->category->slug == 'book-stationary' ||
        isset($sub_category) && $sub_category->category->slug == 'computer-equipments' ||
        isset($sub_category) && $sub_category->category->slug == 'electronics' ||
        isset($sub_category) && $sub_category->category->slug == 'fashion-wear' ||
        isset($sub_category) && $sub_category->category->slug == 'home-appliances' ||
        isset($sub_category) && $sub_category->category->slug == 'mobile-accessories' ||
        isset($sub_category) && $sub_category->category->slug == 'music-instruments' ||
        isset($sub_category) && $sub_category->category->slug == 'sport-fitness' ||
        isset($sub_category) && $sub_category->category->slug == 'toys-games' ||
        isset($product) && $product->category->slug == 'automobiles' ||
        isset($product) && $product->category->slug == 'beauty-health' ||
        isset($product) && $product->category->slug == 'book-stationary' ||
        isset($product) && $product->category->slug == 'computer-equipments' ||
        isset($product) && $product->category->slug == 'electronics' ||
        isset($product) && $product->category->slug == 'fashion-wear'||
        isset($product) && $product->category->slug == 'home-appliances' ||
        isset($product) && $product->category->slug == 'mobile-accessories' ||
        isset($product) && $product->category->slug == 'music-instruments' ||
        isset($product) && $product->category->slug == 'sport-fitness' ||
        isset($product) && $product->category->slug == 'toys-games'
    )
    <div class="row">
        <div class="col-md-6">
            <div class="form-group {{ $errors->has('usedFor_period') ? ' has-error' : '' }} clearfix ">
                <label for="usedFor_period" class="form-label">Used for</label>

                <input type="number" name="usedFor_period" value="{{ old('usedFor_period', $product->usedFor_period ?? '') }}" class="form-control">

                @if ($errors->has('usedFor_period'))
                    <span class="help-block">
                        <strong>{{ $errors->first('usedFor_period') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('usedFor_period_type') ? ' has-error' : '' }} clearfix">
                <label for="usedFor_period_type" class="form-label">Time Period</label>

                <select name = "usedFor_period_type" id="usedFor_period_type" class="form-control form-select">
                    <option disabled selected>Select the period</option>
                    @foreach($time_periods as $key => $time_period)
                        @if(isset($product->usedFor_period_type))
                            <option value = "{{ $key }}" @if($product->usedFor_period_type == $key) selected @endif>
                                {{$time_period}}
                            </option>
                        @elseif(old('time_period') != null)
                            <option value = "{{ $key }}" @if($key == old('time_period')) selected @endif>
                                {{$time_period}}
                            </option>
                        @else
                            <option value = "{{ $key }}">
                                {{$time_period}}
                            </option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('usedFor_period_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('usedFor_period_type') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group {{ $errors->has('warranty_type') ? ' has-error' : '' }} clearfix">
                <label for="warranty_type" class="form-label">Warranty Type</label>

                <select name = "warranty_type" id="warranty_type" class="form-control form-select">
                    <option disabled selected>Select the warranty type</option>
                    @foreach($warranty_types as $key => $warranty_type)
                        @if(isset($product->warranty_type))
                            <option value = "{{ $key }}" @if($product->warranty_type == $key) selected @endif>
                                {{$warranty_type}}
                            </option>
                        @elseif(old('time_period') != null)
                            <option value = "{{ $key }}" @if($key == old('warranty_type')) selected @endif>
                                {{$warranty_type}}
                            </option>
                        @else
                            <option value = "{{ $key }}">
                                {{$warranty_type}}
                            </option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('warranty_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('warranty_type') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('warranty_period') ? ' has-error' : '' }} clearfix ">
                <label for="warranty_period" class="form-label">Warranty Period</label>

                <input type="number" name="warranty_period" value="{{ old('warranty_period', $product->warranty_period ?? '') }}" class="form-control">

                @if ($errors->has('warranty_period'))
                    <span class="help-block">
                        <strong>{{ $errors->first('warranty_period') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('warranty_period_type') ? ' has-error' : '' }} clearfix">
                <label for="warranty_period_type" class="form-label">Time Period</label>

                <select name = "warranty_period_type" id="warranty_period_type" class="form-control form-select">
                    <option disabled selected>Select the period</option>
                    @foreach($time_periods as $key => $time_period)
                        @if(isset($product->warranty_period_type))
                            <option value = "{{ $key }}" @if($product->warranty_period_type == $key) selected @endif>
                                {{$time_period}}
                            </option>
                        @elseif(old('time_period') != null)
                            <option value = "{{ $key }}" @if($key == old('time_period')) selected @endif>
                                {{$time_period}}
                            </option>
                        @else
                            <option value = "{{ $key }}">
                                {{$time_period}}
                            </option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('warranty_period_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('warranty_period_type') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('has_home_delivery') ? ' has-error' : '' }} clearfix ">
                <label for="has_home_delivery" class="form-label">Home Delivery</label>

                <div>
                    <label class="switch">
                        @if(isset($product->has_home_delivery))
                            <input type="checkbox" name="has_home_delivery" @if($product->has_home_delivery == 1) checked @endif>
                        @else
                            <input type="checkbox" name="has_home_delivery">
                        @endif
                        <span class="slider round"></span>
                    </label>
                </div>
                
                @if ($errors->has('has_home_delivery'))
                    <span class="help-block">
                        <strong>{{ $errors->first('has_home_delivery') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group {{ $errors->has('delivery_area') ? ' has-error' : '' }} clearfix">
                <label for="delivery_area" class="form-label">Delivery Area</label>

                <select name = "delivery_area" id="delivery_area" class="form-control form-select">
                    <option disabled selected>Select the delivery Area</option>
                    @foreach($delivery_areas as $key => $delivery_area)
                        @if(isset($product->delivery_area))
                            <option value = "{{ $key }}" @if($product->delivery_area == $key) selected @endif>
                                {{$delivery_area}}
                            </option>
                        @elseif(old('delivery_area') != null)
                            <option value = "{{ $key }}" @if($key == old('delivery_area')) selected @endif>
                                {{$delivery_area}}
                            </option>
                        @else
                            <option value = "{{ $key }}">
                                {{$delivery_area}}
                            </option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('delivery_area'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_area') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group {{ $errors->has('delivery_charge') ? ' has-error' : '' }} clearfix ">
                <label for="delivery_charge" class="form-label">Delivery Charge ($)</label>

                <input type="number" name="delivery_charge" value="{{ old('delivery_charge', $product->delivery_charge ?? '') }}" class="form-control">

                @if ($errors->has('delivery_charge'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_charge') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
@endif

<!--  Fashion Wear Only -->
@if(isset($sub_category) && $sub_category->category->slug == 'fashion-wear' || isset($product) && $product->category->slug == 'fashion-wear')
    <div class="form-group {{ $errors->has('quantity') ? ' has-error' : '' }} clearfix ">
        <label for="quantity" class="form-label">Quantity)</label>

        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}" class="form-control">

        @if ($errors->has('quantity'))
            <span class="help-block">
                <strong>{{ $errors->first('quantity') }}</strong>
            </span>
        @endif
    </div>
@endif

<!-- Food-Drinks & Pet-PetCare -->
@if(isset($sub_category) && $sub_category->category->slug == 'food-drinks' ||
        isset($sub_category) && $sub_category->category->slug == 'pet-pet-care' ||
        isset($product) && $product->category->slug == 'food-drinks' ||
        isset($product) && $product->category->slug == 'pet-pet-care'
    )
    <div class="row">
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('has_home_delivery') ? ' has-error' : '' }} clearfix ">
                <label for="has_home_delivery" class="form-label">Home Delivery</label>

                <div>
                    <label class="switch">
                        @if(isset($product->has_home_delivery))
                            <input type="checkbox" name="has_home_delivery" @if($product->has_home_delivery == 1) checked @endif>
                        @else
                            <input type="checkbox" name="has_home_delivery">
                        @endif
                        <span class="slider round"></span>
                    </label>
                </div>
                
                @if ($errors->has('has_home_delivery'))
                    <span class="help-block">
                        <strong>{{ $errors->first('has_home_delivery') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group {{ $errors->has('delivery_area') ? ' has-error' : '' }} clearfix">
                <label for="delivery_area" class="form-label">Delivery Area</label>

                <select name = "delivery_area" id="delivery_area" class="form-control form-select">
                    <option disabled selected>Select the delivery Area</option>
                    @foreach($delivery_areas as $key => $delivery_area)
                        @if(isset($product->delivery_area))
                            <option value = "{{ $key }}" @if($product->delivery_area == $key) selected @endif>
                                {{$delivery_area}}
                            </option>
                        @elseif(old('delivery_area') != null)
                            <option value = "{{ $key }}" @if($key == old('delivery_area')) selected @endif>
                                {{$delivery_area}}
                            </option>
                        @else
                            <option value = "{{ $key }}">
                                {{$delivery_area}}
                            </option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('delivery_area'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_area') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group {{ $errors->has('delivery_charge') ? ' has-error' : '' }} clearfix ">
                <label for="delivery_charge" class="form-label">Delivery Charge ($)</label>

                <input type="number" name="delivery_charge" value="{{ old('delivery_charge', $product->delivery_charge ?? '') }}" class="form-control">

                @if ($errors->has('delivery_charge'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_charge') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
@endif

<!--  Fashion Wear  & Real State-->
@if(isset($sub_category) && $sub_category->category->slug == 'fashion-wear' || isset($sub_category) && $sub_category->category->slug == 'real-state' || isset($product) && $product->category->slug == 'fashion-wear' || isset($product) && $product->category->slug == 'real-state')
    <div class="form-group {{ $errors->has('size') ? ' has-error' : '' }} clearfix ">
        <label for="size" class="form-label">Size</label>

        <input type="text" name="size" value="{{ old('size', $product->size ?? '') }}" class="form-control">

        @if ($errors->has('size'))
            <span class="help-block">
                <strong>{{ $errors->first('size') }}</strong>
            </span>
        @endif
    </div>
@endif

<!-- Real State Only -->
@if(isset($sub_category) && $sub_category->category->slug == 'real-state' || isset($product) && $product->category->slug == 'real-state')
    <div class="form-group required {{ $errors->has('location') ? ' has-error' : '' }} clearfix ">
        <label for="location" class="form-label">Location</label>

        <input type="text" name="location" value="{{ old('location', $product->location ?? '') }}" class="form-control" required>

        @if ($errors->has('location'))
            <span class="help-block">
                <strong>{{ $errors->first('location') }}</strong>
            </span>
        @endif
    </div>
@endif

<div class="form-group {{ $errors->has('features') ? ' has-error' : '' }} clearfix">
    <label for="features" class="form-label">Feature</label>

    <textarea name="features" class="form-control ckeditor" rows="5">{{ old('features', $product->features ?? '') }}</textarea>

    @if ($errors->has('features'))
        <span class="help-block">
            <strong>{{ $errors->first('features') }}</strong>
        </span>
    @endif
</div>

<div class="form-group required {{ $errors->has('status') ? ' has-error' : '' }} clearfix ">
    <label for="status" class="form-label">Status</label>
    <div>
        <label class="switch">
            @if(isset($product->status))
                <input type="checkbox" name="status" @if($product->status == 1) checked @endif>
            @else
                <input type="checkbox" name="status" checked>
            @endif
            <span class="slider round"></span>
        </label>
    </div>
    
    @if ($errors->has('status'))
        <span class="help-block">
            <strong>{{ $errors->first('status') }}</strong>
        </span>
    @endif
</div>

@if(isset($sub_category))
    <input type="hidden" name="category" value="{{ $sub_category->category->id }}">
    <input type="hidden" name="sub_category" value="{{ $sub_category->id }}">
@elseif(isset($category))
    <input type="hidden" name="category" value="{{ $category->id }}">
@endif