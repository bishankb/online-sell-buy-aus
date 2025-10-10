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
use CyrildeWit\EloquentViewable\Support\Period;
use App\Models\ProductView;
use DB;
use SEOMeta;
use OpenGraph;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($productViewType)
    {
        $this->seoIndex($productViewType);

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
                                    ->withCount('views')
                                    ->orderByDesc('views_count')
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
        $this->seoShow($product);

        if(request('notify_id')) {
            DB::table('notifications')->where('id', request('notify_id'))->where('read_at', null)->update(['read_at' => now()]);
        }

        session()->push('products.recently_viewed', $product->getKey());

        $userId = auth()->id();
        $ip = request()->ip();
        $today = Carbon::today();

        // Only record view if it doesn't exist for today
        ProductView::firstOrCreate(
            [
                'product_id' => $product->id,
                'user_id' => $userId,
                'ip' => $userId ? null : $ip,
                'view_date' => $today,
            ]
        );

        $totalViews = $product->views()->count();


        if($product->sub_category_id != 0) {
            $related_products = Product::where('id', '!=', $product->id)->where('sub_category_id', $product->sub_category_id)->take(10)->get();
        } else {
            $related_products = Product::where('id', '!=', $product->id)->where('category_id', $product->category_id)->take(10)->get();
        }

        $buyer_questions = BuyerQuestion::where('product_id', $product->id)->take(5)->latest()->get();

        return view('frontend.product-section.product-single', compact('product', 'related_products', 'buyer_questions', 'totalViews'));
    }

    /**
     * Filter the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $this->seoFilter();

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
        $this->seoSearch($request->search_product);

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

    private function seoIndex($productViewType)
    {
        SEOMeta::setTitle('Buy and Sell Your Products in Australia -'.env('APP_NAME'));
        SEOMeta::setDescription(env('APP_NAME').' - Buy and Sell your products in australia. Sell the used or brand new products, contact the buyer yourself and look for the products of your desire.');
        SEOMeta::setCanonical(route('product.index', $productViewType));
        SEOMeta::addKeyword(['osbaustralia', 'buy', 'sell', 'brand', 'new', 'used', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand', 'cheap', 'popular', 'product']);
        
        OpenGraph::setTitle('Buy and Sell Your Products in Australia -'.env('APP_NAME'));
        OpenGraph::setDescription(env('APP_NAME').' - Buy and Sell your products in Australia. Sell the used or brand new products, contact the buyer yourself and look for the products of your desire.');
        OpenGraph::setUrl(route('product.index', $productViewType));
    }

    private function seoShow($product)
    {
        SEOMeta::setTitle($product->title.' -'.env('APP_NAME'));
        SEOMeta::setDescription($product->description. '. View the product price and other details. Contact the owner of the product if you find the product suitable.');
        SEOMeta::setCanonical(route('product.show', $product->slug));
        SEOMeta::addMeta('article:posted_on', $product->created_at->toW3CString(), 'posted_on');
        SEOMeta::addKeyword(['osbaustralia', 'description', 'product', 'buy', 'sell', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand']);

        OpenGraph::setTitle($product->title.' -'.env('APP_NAME'));
        OpenGraph::setDescription($product->description. '. View the product price and other details. Contact the owner of the product if you find the product suitable.');
        OpenGraph::setUrl(route('product.show', $product->slug));
       
        OpenGraph::addProperty('locale', 'ne_NP');
        
        if ($product->category) {
            SEOMeta::addMeta('article:category', $product->category->title, 'category');
            OpenGraph::addProperty('category', $product->category->title);
        }
        if ($product->subCategory) {
            SEOMeta::addMeta('article:sub_category', $product->subCategory->title, 'sub_category');
            OpenGraph::addProperty('sub_category', $product->subCategory->title);
        }

        if(count($product->images) > 0) {
            OpenGraph::addImage(env('APP_URL').'/storage/media/product/'.$product->id.'/'.$product->images->first()->filename);
        } else {
           OpenGraph::addImage(env('APP_URL').'/images/no-image.jpg'); 
        }
    }

    private function seoFilter()
    {
        SEOMeta::setTitle('Filter and search products by category, location,condition and price range -'.env('APP_NAME'));
        SEOMeta::setDescription('Filter products by different criteria on '.env('APP_NAME').', find suitable products according to your need and consult the product owner yourself.');
        SEOMeta::setCanonical(route('product.filter'));
        SEOMeta::addKeyword(['osbaustralia', 'filter', 'search', 'sell', 'brand', 'new', 'used', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand', 'price-range', 'categogry', 'sold_product']);
        
        OpenGraph::setTitle('Filter, Search products by category, location,condition and price range -'.env('APP_NAME'));
        OpenGraph::setDescription('Filter products by different criteria on '.env('APP_NAME').', find suitable products according to your need and consult the product owner yourself.');
        OpenGraph::setUrl(route('product.filter'));
    }

    private function seoSearch($search)
    {
        SEOMeta::setTitle('Searched by : '.$search.' -'.env('APP_NAME'));
        SEOMeta::setDescription('Product searched by '. $search .' keyword on '.env('APP_NAME').'. Search your desired product from product title, category and subCategory');
        SEOMeta::setCanonical(route('product.search'));
        SEOMeta::addKeyword(['osbaustralia', 'search', 'category', 'subCategory', 'product', 'buy', 'sell', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand']);
        
        OpenGraph::setTitle('Searched by : '.$search.' -'.env('APP_NAME'));
        OpenGraph::setDescription('Product searched by '. $search .' keyword on '.env('APP_NAME').'. Search your desired product from product title, category and subCategory');
        OpenGraph::setUrl(route('product.search'));
    }
}
