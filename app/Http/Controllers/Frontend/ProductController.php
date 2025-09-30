<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\BuyerQuestion;
use App\Models\City;
use Carbon\Carbon;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($productViewType)
    {
        $categories = Category::get();
        $cities = City::get();
        $condition_types = Product::ConditionType;

        switch ($productViewType) {
            case 'all-products':
                $products = Product::where('status', 1)
                                    ->where('is_sold', 0)
                                    ->where('expiry_period', '>', Carbon::now())
                                    ->sort(request('status'))
                                    ->orderByRaw('RAND()')
                                    ->paginate(config('product.product_paginate'));

                $productViewTypeTitle = 'All Products';
                break;

            case 'featured-products':
                $products = Product::where('status', 1)
                                    ->where('is_sold', 0)
                                    ->where('is_featured', 1)
                                    ->where('expiry_period', '>', Carbon::now())
                                    ->sort(request('status'))
                                    ->latest()
                                    ->paginate(config('product.product_paginate'));

                $productViewTypeTitle = 'Featured Products';
                break;
            case 'latest-products':
                $products = Product::where('status', 1)
                                    ->where('is_sold', 0)
                                    ->where('expiry_period', '>', Carbon::now())
                                    ->sort(request('status'))
                                    ->latest()
                                    ->paginate(config('product.product_paginate'));

                $productViewTypeTitle = 'Latest Products';
                break;
            case 'popular-products':
                $products = Product::where('status', 1)
                                    ->where('is_sold', 0)
                                    ->where('expiry_period', '>', Carbon::now())
                                    ->sort(request('status'))
                                    ->withViewsCount()
                                    ->latest()
                                    ->paginate(config('product.product_paginate'));

                $productViewTypeTitle = 'Popular Products';
                break;
            case 'recently-viewed-products':
                $recentlyViewedIds = session()->get('products.recently_viewed');
                $products = Product::latest()
                                    ->where('status', 1)
                                    ->where('is_sold', 0)
                                    ->where('expiry_period', '>', Carbon::now())
                                    ->sort(request('status'))
                                    ->whereIn('id', $recentlyViewedIds)
                                    ->latest()
                                    ->paginate(config('product.product_paginate'));

                $productViewTypeTitle = 'Recently Viewed Products';
                break;
            default :
                $sub_category = SubCategory::where('slug', $productViewType)->first();

                if(isset($sub_category)) {
                    $products = Product::where('status', 1)
                                        ->where('is_sold', 0)
                                        ->where('expiry_period', '>', Carbon::now())
                                        ->sort(request('status'))
                                        ->where('sub_category_id', $sub_category->id)
                                        ->latest()
                                        ->paginate(config('product.product_paginate'));

                    $productViewTypeTitle = $sub_category->title;

                } else {
                    $category = Category::where('slug', $productViewType)->first();
                    if(isset($category)) {
                        $products = Product::where('status', 1)
                                            ->where('is_sold', 0)
                                            ->where('expiry_period', '>', Carbon::now())
                                            ->sort(request('status'))
                                            ->where('category_id', $category->id)
                                            ->latest()
                                            ->paginate(config('product.product_paginate'));

                        $productViewTypeTitle = $category->title;

                        $subCategories = $category->subCategories;

                        return view('frontend.product-section.product-list', compact('productViewTypeTitle', 'subCategories', 'products', 'categories', 'cities', 'condition_types'));

                    } else {
                        abort(404);
                    }
                }
        }

        return view('frontend.product-section.product-list', compact('productViewTypeTitle', 'products', 'categories', 'cities', 'condition_types'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        session()->push('products.recently_viewed', $product->getKey());

        $product->addView();

        if($product->sub_category_id != 0) {
            $related_products = Product::where('id', '!=', $product->id)->where('sub_category_id', $product->sub_category_id)->take(10)->get();
        } else {
            $related_products = Product::where('id', '!=', $product->id)->where('category_id', $product->category_id)->take(10)->get();
        }

        $buyer_questions = BuyerQuestion::where('product_id', $product->id)->take(5)->latest()->get();

        return view('frontend.product-section.product-single', compact('product', 'related_products', 'buyer_questions'));
    }

    /**
     * Filter the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $filter_products = Product::sort(request('status'))
                            ->where('status', 1)
                            ->with('createdBy')
                            ->where('expiry_period', '>', Carbon::now());

        $title = request('title');
        if (isset($title)) {
            $filter_products->where('title', 'like', '%' . $title . '%');
        }

        $category = request('category');
        if (isset($category)) {
            $category = Category::where('slug', $category)->first();
            $categoryId = $category->id;
            $filter_products->where('category_id', $categoryId);
        }

        $sub_category = request('sub_category');
        if (isset($sub_category)) {
            $sub_category = SubCategory::where('slug', $sub_category)->first();
            $subCategoryId = $sub_category->id;
            $filter_products->where('category_id', $subCategoryId);
        }

        $city = request('city');

        if (isset($city)) {
            $city = City::where('name', $city)->first();
            $cityId = $city->id;
            $filter_products->whereHas(
                'createdBy',
                function ($filter_products) use ($cityId)  {
                    $filter_products->whereHas(
                        'profile',
                        function ($filter_products) use ($cityId) {
                             $filter_products->where('city_id', $cityId);
                        }
                    );
                }
            );
        }

        $condition_type = request('condition_type');
        if (isset($condition_type)) {
            $filter_products->where('condition_type', $condition_type);
        }

        $min_price = request('min_price');
        if (isset($min_price)) {
            $filter_products->where('price', '>=', $min_price);
        }

        $max_price = request('max_price');
        if (isset($max_price)) {
            $filter_products->where('price', '<=', $max_price);
        }

        if(isset($min_price) && isset($max_price)) {
             $filter_products->where('price', '>=', $min_price)->where('price', '<', $max_price);
        }

        $sold_product = request('sold_product');
        if (isset($sold_product)) {
            $filter_products;
        } else {
            $filter_products->where('is_sold', 0);
        }

        $categories = Category::get();
        $cities = City::get();
        $condition_types = Product::ConditionType;

        $products = $filter_products
                    ->paginate(config('product.product_paginate'));
        
        return view('frontend.product-section.product-list', compact('products', 'categories', 'cities', 'condition_types'));
    }

    /**
     * Filter the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $categories = Category::get();
        $cities = City::get();
        $condition_types = Product::ConditionType;

        $products = Product::sort(request('status'))
                            ->where('status', 1)
                            ->where('is_sold', 0)
                            ->where('expiry_period', '>', Carbon::now())
                            ->search(request('search_product'))
                            ->paginate(config('product.product_paginate'));
        
        return view('frontend.product-section.product-list', compact('products', 'categories', 'cities', 'condition_types'));
    }
}
