<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
    	$latest_products = Product::where('status', 1)
                                    ->where('is_sold', 0)
                                    ->where('expiry_period', '>', Carbon::now())
                                    ->latest()
                                    ->take(config('product.home_product'))
                                    ->get();

    	$popular_products = Product::where('status', 1)
                                    ->where('is_sold', 0)
                                    ->where('expiry_period', '>', Carbon::now())
                                    ->withCount('views')
                                    ->orderBy('views_count', 'desc')
                                    ->get();

    	if(session()->has('products.recently_viewed')) {
    		$recentlyViewedIds = session()->get('products.recently_viewed');
    		$recentlyViewed_products = Product::latest()
                                                ->where('status', 1)
                                                ->where('is_sold', 0)
                                                ->where('expiry_period', '>', Carbon::now())
                                                ->whereIn('id', $recentlyViewedIds)
                                                ->take(config('product.home_product'))
                                                ->get();
    	} else {
    		$recentlyViewed_products = [];
    	}

    	$categories = Category::where('status', 1)->get();

        return view('frontend.home', compact('latest_products', 'popular_products', 'recentlyViewed_products', 'categories'));
    }
}
