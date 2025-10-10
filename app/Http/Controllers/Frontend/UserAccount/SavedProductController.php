<?php

namespace App\Http\Controllers\Frontend\UserAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;

class SavedProductController extends Controller
{

	public function index()
	{
	    $saved_products = Auth::user()->savedProducts()
	    						->categoryFilter(request('category'))
                            	->subCategoryFilter(request('sub_category'))
                            	->frontendSearch(request('search-item'))
                            	->where('status', 1)
								->latest()
								->paginate(config('product.table_paginate'));

		$categories = Category::select('title', 'slug')->get();
        $sub_categories = SubCategory::select('title', 'slug')->get();
								
    	return view('frontend.user-dashboard.saved-product.index', compact('saved_products', 'categories', 'sub_categories'));
	}

	/**
     * Unnsave the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unsaveProduct(Request $request, $slug)
    {
    	$product = Product::where('slug', $slug)->firstOrFail();
        $user = Auth::user();

        try {
	        if ($user->savedProducts()->where('product_id', $product->id)->exists()) {
	            // Unsave
	            $user->savedProducts()->detach($product->id);
	            $status = 'unsaved';

		         $notification = array(
	                'success'    => 'Product unsaved successfully.',
	            );
	        }
	    } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }


        return redirect()->route('saved-product.index')->with($notification);
    }
}