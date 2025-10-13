<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use DB;
use SEOMeta;
use OpenGraph;

class HomeController extends Controller
{
    public function index()
    {
        if(request('notify_id')) {
            DB::table('notifications')->where('id', request('notify_id'))->where('read_at', null)->update(['read_at' => now()]);
        }
        
        $this->seoIndex();

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
                                    ->take(config('product.home_product'))
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

    private function seoIndex()
    {
        SEOMeta::setTitle('Sell and Buy Your Products in Australia -'.env('APP_NAME'));
        SEOMeta::setDescription(env('APP_NAME').' - Sell and Buy your products in Australia. Sell the used or brand new products, contact the buyer yourself and look for the products of your desire.');
        SEOMeta::setCanonical(route('frontend.home'));
        SEOMeta::addKeyword(['osbaustralia', 'Australia', 'buy', 'sell', 'brand', 'new', 'used', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand', 'cheap', 'popular', 'product']);
        
        OpenGraph::setTitle('Sell and Buy Your Products in Australia -'.env('APP_NAME'));
        OpenGraph::setDescription(env('APP_NAME').' - Sell and Buy your products in Australia. Sell the used or brand new products, contact the buyer yourself and look for the products of your desire.');
        OpenGraph::setUrl(route('frontend.home'));
    }
}
