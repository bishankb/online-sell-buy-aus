<div class="form-group required {{ $errors->has('title') ? ' has-error' : '' }} clearfix ">
    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}

    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required' ]) !!}

    @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>

<div class="form-group required {{ $errors->has('description') ? ' has-error' : '' }} clearfix">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}

    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5', 'required' => 'required']) !!}

    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group required {{ $errors->has('price') ? ' has-error' : '' }} clearfix ">
            {!! Form::label('price', 'Price (Rs)', ['class' => 'control-label']) !!}

            {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required' ]) !!}

            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group required {{ $errors->has('is_negotiable') ? ' has-error' : '' }} clearfix ">
            {!! Form::label('is_negotiable', 'Negotiable', ['class' => 'control-label']) !!}
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
    {!! Form::label('condition_type', 'Condition', ['class' => 'control-label']) !!}

    {!! Form::select('condition_type', $condition_types, null,['id'=>'condition_type', 'class' => 'form-control', 'placeholder' => 'Select the condition type']) !!}

    @if ($errors->has('condition_type'))
        <span class="help-block">
            <strong>{{ $errors->first('condition_type') }}</strong>
        </span>
    @endif
</div>


@isset($product)
    <div class="form-group required {{ $errors->has('expiry_period') ? ' has-error' : '' }} clearfix">
        {!! Form::label('expiry_period', 'Product Expiry Period', ['class' => 'control-label']) !!}

        {!! Form::select('expiry_period', $expiry_periods, $product->expiry_period_type, ['id'=>'expiry_period', 'class' => 'form-control', 'placeholder' => 'Select the expiry period']) !!}

        @if ($errors->has('expiry_period'))
            <span class="help-block">
                <strong>{{ $errors->first('expiry_period') }}</strong>
            </span>
        @endif
    </div>
@else
    <div class="form-group required {{ $errors->has('expiry_period') ? ' has-error' : '' }} clearfix">
        {!! Form::label('expiry_period', 'Ad Expiry Period', ['class' => 'control-label']) !!}

        {!! Form::select('expiry_period', $expiry_periods, null, ['id'=>'expiry_period', 'class' => 'form-control', 'placeholder' => 'Select the expiry period']) !!}

        @if ($errors->has('expiry_period'))
            <span class="help-block">
                <strong>{{ $errors->first('expiry_period') }}</strong>
            </span>
        @endif
    </div>
@endif

<!--  Automobiles Only -->
@if(isset($sub_category) && $sub_category->category->slug == 'automobiles' || isset($product) && $product->category->slug == 'automobiles')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group required {{ $errors->has('make_year') ? ' has-error' : '' }} clearfix ">
                {!! Form::label('make_year', 'Make Year', ['class' => 'control-label']) !!}

                {!! Form::number('make_year', null, ['class' => 'form-control', 'required' => 'required' ]) !!}

                @if ($errors->has('make_year'))
                    <span class="help-block">
                        <strong>{{ $errors->first('make_year') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('kilometer_run') ? ' has-error' : '' }} clearfix ">
                {!! Form::label('kilometer_run', 'Kilometer Run', ['class' => 'control-label']) !!}

                {!! Form::text('kilometer_run', null, ['class' => 'form-control']) !!}

                @if ($errors->has('kilometer_run'))
                    <span class="help-block">
                        <strong>{{ $errors->first('kilometer_run') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
           <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }} clearfix ">
                {!! Form::label('color', 'Color', ['class' => 'control-label']) !!}

                {!! Form::text('color', null, ['class' => 'form-control']) !!}

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
        {!! Form::label('manufacturer', 'Manufacturer', ['class' => 'control-label']) !!}

        {!! Form::text('manufacturer', null, ['class' => 'form-control' ]) !!}

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
                {!! Form::label('usedFor_period', 'Used for', ['class' => 'control-label']) !!}

                {!! Form::number('usedFor_period', null, ['class' => 'form-control']) !!}

                @if ($errors->has('usedFor_period'))
                    <span class="help-block">
                        <strong>{{ $errors->first('usedFor_period') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('usedFor_period_type') ? ' has-error' : '' }} clearfix">
                {!! Form::label('usedFor_period_type', 'Time Period', ['class' => 'control-label']) !!}

                {!! Form::select('usedFor_period_type', $time_periods, null,['id'=>'usedFor_period_type', 'class' => 'form-control', 'placeholder' => 'Select the period']) !!}

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
                {!! Form::label('warranty_type', 'Warranty Type', ['class' => 'control-label']) !!}

                {!! Form::select('warranty_type', $warranty_types, null,['id'=>'warranty_type', 'class' => 'form-control', 'placeholder' => 'Select the warranty type']) !!}

                @if ($errors->has('warranty_type'))
                    <span class="help-block">
                        <strong>{{ $errors->first('warranty_type') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('warranty_period') ? ' has-error' : '' }} clearfix ">
                {!! Form::label('warranty_period', 'Warranty Period', ['class' => 'control-label']) !!}

                {!! Form::number('warranty_period', null, ['class' => 'form-control']) !!}

                @if ($errors->has('warranty_period'))
                    <span class="help-block">
                        <strong>{{ $errors->first('warranty_period') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group {{ $errors->has('warranty_period_type') ? ' has-error' : '' }} clearfix">
                {!! Form::label('warranty_period_type', 'Time Period', ['class' => 'control-label']) !!}

                {!! Form::select('warranty_period_type', $time_periods, null,['id'=>'warranty_period_type', 'class' => 'form-control', 'placeholder' => 'Select the period']) !!}

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
                {!! Form::label('has_home_delivery', 'Home Delivery', ['class' => 'control-label']) !!}
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
                {!! Form::label('delivery_area', 'Delivery Area', ['class' => 'control-label']) !!}

                {!! Form::select('delivery_area', $delivery_areas, null,['id'=>'delivery_area', 'class' => 'form-control', 'placeholder' => 'Select the delivery Area']) !!}

                @if ($errors->has('delivery_area'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_area') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group {{ $errors->has('delivery_charge') ? ' has-error' : '' }} clearfix ">
                {!! Form::label('delivery_charge', 'Delivery Charge (Rs)', ['class' => 'control-label']) !!}

                {!! Form::number('delivery_charge', null, ['class' => 'form-control']) !!}

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
        {!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}

        {!! Form::number('quantity', null, ['class' => 'form-control' ]) !!}

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
                {!! Form::label('has_home_delivery', 'Home Delivery', ['class' => 'control-label']) !!}
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
                {!! Form::label('delivery_area', 'Delivery Area', ['class' => 'control-label']) !!}

                {!! Form::select('delivery_area', $delivery_areas, null,['id'=>'delivery_area', 'class' => 'form-control', 'placeholder' => 'Select the delivery Area']) !!}

                @if ($errors->has('delivery_area'))
                    <span class="help-block">
                        <strong>{{ $errors->first('delivery_area') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group {{ $errors->has('delivery_charge') ? ' has-error' : '' }} clearfix ">
                {!! Form::label('delivery_charge', 'Delivery Charge (Rs)', ['class' => 'control-label']) !!}

                {!! Form::number('delivery_charge', null, ['class' => 'form-control']) !!}

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
        {!! Form::label('size', 'Size', ['class' => 'control-label']) !!}

        {!! Form::text('size', null, ['class' => 'form-control']) !!}

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
        {!! Form::label('location', 'Location', ['class' => 'control-label']) !!}

        {!! Form::text('location', null, ['class' => 'form-control', 'required' => 'required' ]) !!}

        @if ($errors->has('location'))
            <span class="help-block">
                <strong>{{ $errors->first('location') }}</strong>
            </span>
        @endif
    </div>
@endif

<div class="form-group {{ $errors->has('features') ? ' has-error' : '' }} clearfix">
    {!! Form::label('features', 'Feature', ['class' => 'control-label']) !!}

    {!! Form::textarea('features', null, ['class' => 'form-control custom-textarea', 'id' => 'custom-textarea']) !!}

    @if ($errors->has('features'))
        <span class="help-block">
            <strong>{{ $errors->first('features') }}</strong>
        </span>
    @endif
</div>

<div class="form-group required {{ $errors->has('status') ? ' has-error' : '' }} clearfix ">
    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
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