@if ($errors->any())
    <br>
    <div class="callout callout-danger">
        <strong>Whoops!</strong> There were some problems with your input:
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br>
@endif

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
                    <input type="hidden" name="is_negotiable" value="0">

                    <input type="checkbox" name="is_negotiable" id="is_negotiable" value="1"
                           @if(old('is_negotiable') !== null)
                               {{ old('is_negotiable') ? 'checked' : '' }}
                           @elseif(isset($product))
                               {{ $product->is_negotiable ? 'checked' : '' }}
                           @endif
                    >
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

            <option value="{{ $key }}"
                @if(old('condition_type') !== null)
                    {{ old('condition_type') == $key ? 'selected' : '' }}
                @elseif(isset($product) && $product->condition_type == $key)
                    selected
                @endif
            >
                {{ $condition_type }}
            </option>
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
            <option value="{{ $key }}"
                @if(old('expiry_period') !== null)
                    {{ old('expiry_period') == $key ? 'selected' : '' }}
                @elseif(isset($product) && $product->expiry_period_type == $key)
                    selected
                @endif
            >
                {{ $expiry_period }}
            </option>
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
                        <option value="{{ $key }}"
                            @if(old('usedFor_period_type') !== null)
                                {{ old('usedFor_period_type') == $key ? 'selected' : '' }}
                            @elseif(isset($product) && $product->usedFor_period_type == $key)
                                selected
                            @endif
                        >
                            {{ $time_period }}
                        </option>
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
                        <option value="{{ $key }}"
                            @if(old('warranty_type') !== null)
                                {{ old('warranty_type') == $key ? 'selected' : '' }}
                            @elseif(isset($product) && $product->warranty_type == $key)
                                selected
                            @endif
                        >
                            {{ $warranty_type }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('warranty_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('warranty_type') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4" id="warrantyPeriod_div">
            <div class="form-group {{ $errors->has('warranty_period') ? ' has-error' : '' }} clearfix ">
                <label for="warranty_period" class="form-label">Warranty Period</label>

                <input type="number" name="warranty_period" id="warranty_period" value="{{ old('warranty_period', $product->warranty_period ?? '') }}" class="form-control">

                @if ($errors->has('warranty_period'))
                    <span class="help-block">
                        <strong>{{ $errors->first('warranty_period') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4" id="warrantyPeriodType_div">
            <div class="form-group {{ $errors->has('warranty_period_type') ? ' has-error' : '' }} clearfix">
                <label for="warranty_period_type" class="form-label">Time Period</label>

                <select name = "warranty_period_type" id="warranty_period_type" class="form-control form-select">
                    <option disabled selected>Select the period</option>
                    @foreach($time_periods as $key => $time_period)
                        <option value="{{ $key }}"
                            @if(old('warranty_period_type') !== null)
                                {{ old('warranty_period_type') == $key ? 'selected' : '' }}
                            @elseif(isset($product) && $product->warranty_period_type == $key)
                                selected
                            @endif
                        >
                            {{ $time_period }}
                        </option>
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
                        <input type="hidden" name="has_home_delivery" value="0">

                        <input type="checkbox" name="has_home_delivery" id="has_home_delivery" value="1"
                               @if(old('has_home_delivery') !== null)
                                   {{ old('has_home_delivery') ? 'checked' : '' }}
                               @elseif(isset($product))
                                   {{ $product->has_home_delivery ? 'checked' : '' }}
                               @endif
                        >
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

        <div class="col-md-5" id="deliveryArea_div">
            <div class="form-group {{ $errors->has('delivery_area') ? ' has-error' : '' }} clearfix">
                <label for="delivery_area" class="form-label">Delivery Area</label>

                <select name = "delivery_area" id="delivery_area" class="form-control form-select">
                    <option value="">Select the delivery Area</option>
                    @foreach($delivery_areas as $key => $delivery_area)
                        <option value="{{ $key }}"
                            @if(old('delivery_area') !== null)
                                {{ old('delivery_area') == $key ? 'selected' : '' }}
                            @elseif(isset($product) && $product->delivery_area == $key)
                                selected
                            @endif
                        >
                            {{ $delivery_area }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('delivery_area'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_area') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-5" id="deliveryCharge_div">
            <div class="form-group {{ $errors->has('delivery_charge') ? ' has-error' : '' }} clearfix ">
                <label for="delivery_charge" class="form-label">Delivery Charge ($)</label>

                <input type="number" name="delivery_charge" id="delivery_charge" value="{{ old('delivery_charge', $product->delivery_charge ?? '') }}" class="form-control">

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
                        <input type="hidden" name="has_home_delivery" value="0">

                        <input type="checkbox" name="has_home_delivery" id="has_home_delivery" value="1"
                               @if(old('has_home_delivery') !== null)
                                   {{ old('has_home_delivery') ? 'checked' : '' }}
                               @elseif(isset($product))
                                   {{ $product->has_home_delivery ? 'checked' : '' }}
                               @endif
                        >
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

        <div class="col-md-5" id="deliveryArea_div">
            <div class="form-group {{ $errors->has('delivery_area') ? ' has-error' : '' }} clearfix">
                <label for="delivery_area" class="form-label">Delivery Area</label>

                <select name = "delivery_area" id="delivery_area" class="form-control form-select">
                    <option value=""Select the delivery Area</option>
                    @foreach($delivery_areas as $key => $delivery_area)
                        <option value="{{ $key }}"
                            @if(old('delivery_area') !== null)
                                {{ old('delivery_area') == $key ? 'selected' : '' }}
                            @elseif(isset($product) && $product->delivery_area == $key)
                                selected
                            @endif
                        >
                            {{ $delivery_area }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('delivery_area'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_area') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-5" id="deliveryCharge_div">
            <div class="form-group {{ $errors->has('delivery_charge') ? ' has-error' : '' }} clearfix ">
                <label for="delivery_charge" class="form-label">Delivery Charge ($)</label>

                <input type="number" name="delivery_charge" id="delivery_charge" value="{{ old('delivery_charge', $product->delivery_charge ?? '') }}" class="form-control">

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
            <input type="hidden" name="status" value="0">

            <input type="checkbox" name="status" value="1"
                   @if(old('status') !== null)
                       {{ old('status') ? 'checked' : '' }}
                   @elseif(isset($product))
                       {{ $product->status ? 'checked' : '' }}
                   @else
                       checked
                   @endif
            >
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