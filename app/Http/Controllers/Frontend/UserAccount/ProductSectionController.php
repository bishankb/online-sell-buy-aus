<?php

namespace App\Http\Controllers\Frontend\UserAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Auth;
use DB;
use Illuminate\Support\Str;

class ProductSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::categoryFilter(request('category'))
                            ->subCategoryFilter(request('sub_category'))
                            ->soldItemFilter(request('sold-items'))
                            ->featuredItemFilter(request('featured-items'))
                            ->expiredItemFilter(request('expired-items'))
                            ->frontendSearch(request('search-item'))
                            ->where('created_by', Auth::user()->id)
                            ->where('status', 1)
                            ->latest()
                            ->paginate(config('product.table_paginate'));

        $categories = Category::select('title', 'slug')->get();
        $sub_categories = SubCategory::select('title', 'slug')->get();

        return view('frontend.user-dashboard.product-section.index', compact('products', 'categories', 'sub_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->where('created_by', Auth::user()->id)->firstOrFail();
        $expiry_periods = Product::ExpiryPeriod;
        $condition_types = Product::ConditionType;
        $time_periods = Product::TimePeriod;
        $delivery_areas = Product::DeliveryArea;
        $warranty_types = Product::WarrantyTypes;

        return view('frontend.user-dashboard.product-section.edit', compact('product', 'expiry_periods', 'condition_types', 'time_periods', 'delivery_areas', 'warranty_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->where('created_by', Auth::user()->id)->firstOrFail();

        //Automobiles Only
        if ($product->category->slug == 'automobiles') {
            $this->validate($request, [
                'make_year'               => 'required|numeric'
            ]);
        }

        //Automobiles & Computer-Equipments & Electronics & Fashion-Wear & Mobile-Accessories
        if ($product->category->slug == 'automobiles' ||
            $product->category->slug == 'computer-equipments' ||
            $product->category->slug == 'electronics' ||
            $product->category->slug == 'fashion-wear' ||
            $product->category->slug == 'mobile-accessories'
        ) {
            $this->validate($request, [
                'manufacturer'            => 'nullable|min:2|max:255',
            ]);
        }

        //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games
        if ($product->category->slug == 'automobiles' ||
            $product->category->slug == 'beauty-health' ||
            $product->category->slug == 'book-stationary' ||
            $product->category->slug == 'computer-equipments' ||
            $product->category->slug == 'electronics' ||
            $product->category->slug == 'fashion-wear' ||
            $product->category->slug == 'home-appliances' ||
            $product->category->slug == 'mobile-accessories' ||
            $product->category->slug == 'music-instruments' ||
            $product->category->slug == 'sport-fitness' ||
            $product->category->slug == 'toys-games'

        ) {
            $this->validate($request, [
                'usedFor_period'          => 'nullable|numeric',
                'warranty_period'         => 'nullable|numeric',
                'delivery_charge'         => 'nullable|numeric',
                
            ]);
        }

        //Fashion Wear Only
        if ($product->category->slug == 'fashion-wear') {
            $this->validate($request, [
                'quantity'                 => 'nullable|numeric',
            ]);
        }

        //Food-Drinks & Pet-PetCare
        if ($product->category->slug == 'food-drinks' ||
            $product->category->slug == 'pet-pet-care'
        ) {
            $this->validate($request, [
               'delivery_charge'         => 'nullable|numeric',
            ]);
        }

        //Real State Only
        if ($product->category->slug == 'real-state') {
            $this->validate($request, [
                'location'   => 'required|min:2',
            ]);
        }

        $this->validate($request, [
            'title'                   => 'required|min:2|max:255',
            'description'             => 'required|min:2',
            'price'                   => 'required|numeric',
            'condition_type'          => 'required',
            'is_negotiable'           => 'nullable',
            'expiry_period'           => 'required',
            'features'                => 'nullable|min:2',           
        ]);

        $expiryPeriod = [
            Carbon::now()->addMonth(1),
            Carbon::now()->addMonth(2),
            Carbon::now()->addMonth(4),
            Carbon::now()->addMonth(6),
            Carbon::now()->addWeek(1),
            Carbon::now()->addWeek(2),
        ];
        
        DB::beginTransaction();
        try {
            if ($product->title != request('title')) {
                $product->update(['slug' => $this->setSlugAttribute(request('title'))]);
            }

            $product->update(
                [
                    'title'                   => request('title'),
                    'description'             => request('description'),
                    'price'                   => request('price'),
                    'condition_type'          => request('condition_type'),
                    'is_negotiable'           => request('is_negotiable') ? 1 : 0,
                    'expiry_period'           => $expiryPeriod[request('expiry_period')],
                    'expiry_period_type'      => request('expiry_period'),
                    'features'                => request('features'),
                    
                    //Automobiles Only
                    'kilometer_run'           => request('kilometer_run'),
                    'make_year'               => request('make_year'),
                    'color'                   => request('color'),

                    //Automobiles & Computer-Equipments & Electronics & Fashion-Wear & Mobile-Accessories
                    'manufacturer'            => request('manufacturer'),

                    //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games
                    'usedFor_period'          => request('usedFor_period'),
                    'usedFor_period_type'     => request('usedFor_period_type'),
                    'warranty_type'           => request('warranty_type'),
                    'warranty_period'         => request('warranty_period'),
                    'warranty_period_type'    => request('warranty_period_type'),

                    //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games & Food-Drinks & Pet-PetCare
                    'has_home_delivery'       => request('has_home_delivery') ? 1 : 0,
                    'delivery_area'           => request('delivery_area'),
                    'delivery_charge'          => request('delivery_charge'),

                    //Fashion Wear Only
                    'quantity'                => request('quantity'),

                    //Fashion Wear & Real State
                    'size'                    => request('size'),

                    //Real State Only
                    'location'                => request('location'),

                    'updated_by'              => Auth::user()->id,
                ]
            );
   
            DB::commit();
            $notification = array(
                'success'    => 'Product updated successfully.',
            );
        } catch (\Exception $exception) {
            DB::rollback();
            logger()->error($exception->getMessage());
            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }

        return redirect()->route('product-section.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product = Product::where('slug', $slug)->where('created_by', Auth::user()->id)->firstOrFail();

        try {
            $product->delete();
            $notification = array(
                'success'    => 'Product deleted successfully.',
            );
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }

        return redirect()->route('product-section.index')->with($notification);
    }

    /**
     * Mark or unmark the product as sold.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markSold(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->where('created_by', Auth::user()->id)->firstOrFail();

        try {
            $product->update([
                'is_sold' => request('is_sold')
            ]);

            if($product->is_sold == 1) {
                $notification = array(
                    'success'    => 'Product marked as sold.',
                );
            } else {
                $notification = array(
                    'success'    => 'Product marked as unsold.',
                );
            }

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());

            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }

        return redirect()->route('product-section.index')->with($notification);
    }

    /**
     * Renew the product after expried.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function renew(Request $request, $slug)
    {
        $product = Product::where('expiry_period', '<', Carbon::now())->where('slug', $slug)->where('created_by', Auth::user()->id)->firstOrFail();
        
        $expiryPeriod = [
            Carbon::now()->addMonth(1),
            Carbon::now()->addMonth(2),
            Carbon::now()->addMonth(4),
            Carbon::now()->addMonth(6),
            Carbon::now()->addWeek(1),
            Carbon::now()->addWeek(2),
        ];

        try {
            $product->update(
                [
                    'expiry_period' => $expiryPeriod[$product->expiry_period_type]
                ]
            );
            $notification = array(
                'success'    => 'Product renewed successfully.',
            );
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }

        return redirect()->route('product-section.index')->with($notification);
    }

    /**
     * Creating the unique slug.
     *
     */
    private function setSlugAttribute($slug)
    {
        $slug = Str::slug($slug);
        $slugs = Product::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")
                    ->orderBy('id')
                    ->pluck('slug');
        if (count($slugs) == 0) {
            return $slug;
        } elseif (! $slugs->isEmpty()) {
            $pieces = explode('-', $slugs);
            $number = (int) end($pieces);
            return $slug .= '-' . ($number + 1);
        }
    }
}
