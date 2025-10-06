<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use DB;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Str;
use App\Notifications\FeaturedProductNotification;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_products', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_products', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_products', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_products', ['only' => 'destroy']);
    }

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
                            ->statusFilter(request('status'))
                            ->search(request('search-item'))
                            ->deletedItemFilter(request('deleted-items'))
                            ->latest()
                            ->paginate(config('product.table_paginate'));
                            
        $categories = Category::select('title', 'slug')->get();
        $sub_categories = SubCategory::select('title', 'slug')->get();
               
        return view('backend.product.index', compact('products', 'categories', 'sub_categories'));
    }

    /**
     * Show the categories and sub-categories lists.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCategories()
    {
        $categories = Category::where('status', 1)->select('title', 'id')->get();
        $sub_categories = SubCategory::where('status', 1)->select('title', 'id')->get();

        return view('backend.product.add-category', compact('categories', 'sub_categories'));
    }   

    /**
     * Get the sub-categories of the particular category
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubCategories($category_id)
    {
        $sub_categories = SubCategory::where('category_id', $category_id)->select('id', 'title')->get();

        return response()->json([
            'sub_categories'=>$sub_categories
        ], 200);
    }

    /**
     * Redirect the form to create page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectProductForm(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|integer',
        ]);       

        if(isset($request->sub_category)) {
            $sub_category = SubCategory::find(request('sub_category'));
            
            return redirect()->route('products.create', $sub_category->slug);
        } else {
            $category = Category::find(request('category'));
            
            return redirect()->route('products.create', $category->slug);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subCategorySlug)
    {
        $sub_category = SubCategory::where('slug', $subCategorySlug)->first();
        $expiry_periods = Product::ExpiryPeriod;
        $condition_types = Product::ConditionType;
        $time_periods = Product::TimePeriod;
        $delivery_areas = Product::DeliveryArea;
        $warranty_types = Product::WarrantyTypes;

        if(isset($sub_category)) { 
            $sub_category = $sub_category;

            return view('backend.product.create', compact('sub_category', 'expiry_periods', 'condition_types', 'time_periods', 'delivery_areas', 'warranty_types'));
        } else {
            $category = Category::where('slug', $subCategorySlug)->first();

            return view('backend.product.create', compact('category', 'expiry_periods', 'condition_types', 'time_periods', 'delivery_areas', 'warranty_types'));
        }    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::find(request('category'));

        //Automobiles Only
        if ($category->slug == 'automobiles') {
            $this->validate($request, [
                'kilometer_run'           => 'numeric',
                'make_year'               => 'required|numeric',
            ]);
        }

        //Automobiles & Computer-Equipments & Electronics & Fashion-Wear & Mobile-Accessories
        if ($category->slug == 'automobiles' ||
            $category->slug == 'computer-equipments' ||
            $category->slug == 'electronics' ||
            $category->slug == 'fashion-wear' ||
            $category->slug == 'mobile-accessories'
        ) {
            $this->validate($request, [
                'manufacturer'            => 'nullable|min:2|max:255',
            ]);
        }

        //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games
        if ($category->slug == 'automobiles' ||
            $category->slug == 'beauty-health' ||
            $category->slug == 'book-stationary' ||
            $category->slug == 'computer-equipments' ||
            $category->slug == 'electronics' ||
            $category->slug == 'fashion-wear' ||
            $category->slug == 'home-appliances' ||
            $category->slug == 'mobile-accessories' ||
            $category->slug == 'music-instruments' ||
            $category->slug == 'sport-fitness' ||
            $category->slug == 'toys-games'
        ) {
            $this->validate($request, [
                'usedFor_period'          => 'nullable|numeric',
                'warranty_period'         => 'nullable|numeric',
                'delivery_charge'         => 'nullable|numeric',                
            ]);   
        }

        //Fashion-Wear Only
        if ($category->slug == 'fashion-wear') {
            $this->validate($request, [
                'quantity'                 => 'nullable|numeric',
            ]);
        }

        //Food-Drinks & Pet-PetCare
        if ($category->slug == 'food-drinks' ||
            $category->slug == 'pet-pet-care'
        ) {
            $this->validate($request, [
               'delivery_charge'         => 'nullable|numeric',
            ]);
        }

        //Real State Only
        if ($category->slug == 'real-state') {
            $this->validate($request, [
                'location'   => 'required|min:2',
            ]);
        }

        $this->validate($request, [
            'category'                => 'required',
            'title'                   => 'required|min:2|max:255',
            'description'             => 'required|min:2',
            'price'                   => 'required|numeric|min:1',
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
            $product = Product::create(
                [
                    'category_id'             => request('category'),
                    'sub_category_id'         => request('sub_category') ? request('sub_category') : 0,
                    'title'                   => request('title'),
                    'slug'                    => $this->setSlugAttribute(request('title')),
                    'description'             => request('description'),
                    'price'                   => request('price'),
                    'condition_type'          => request('condition_type'),
                    'is_negotiable'           => request('is_negotiable') ? 1 : 0,
                    'expiry_period'           => $expiryPeriod[request('expiry_period')],
                    'expiry_period_type'      => request('expiry_period'),
                    'features'                => request('features'),
                    'status'                  => request('status') ? 1 : 0,

                    //Automobiles Only
                    'kilometer_run'           => request('kilometer_run'),
                    'make_year'               => request('make_year'),
                    'color'                   => request('color'),

                    //Automobiles & Computer-Equipments & Electronics & Fashion-Wear & Mobile-Accessories
                    'manufacturer'            => request('manufacturer'),

                    //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games
                    'usedFor_period'          => request('usedFor_period'),
                    'usedFor_period_type'     => request('usedFor_period_type'),
                    'warranty_type'           => request('warranty_type'),
                    'warranty_period'         => request('warranty_period'),
                    'warranty_period_type'    => request('warranty_period_type'),

                    //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games & Food-Drinks & Pet-PetCare
                    'has_home_delivery'       => request('has_home_delivery') ? 1 : 0,
                    'delivery_area'           => request('delivery_area'),
                    'delivery_charge'          => request('delivery_charge'),

                    //Fashion-Wear Only
                    'quantity'                => request('quantity'),

                    //Fashion-Wear & Real State
                    'size'                    => request('size'),

                    //Real State Only
                    'location'                => request('location'),

                    'created_by'              => Auth::user()->id,
                    'updated_by'              => Auth::user()->id,
                ]
            );

            DB::commit();
            flash('Product added successfully. Please add images if you have')->success();
    
            return redirect(route('products.addImages', $product->slug));
        } catch (\Exception $exception) {
            DB::rollback();
            logger()->error($exception->getMessage());
            flash('There was some intenal error while adding the product.')->error();

            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addImages($productSlug)
    {
        $product = Product::withTrashed()->where('slug', $productSlug)->first();
        $productImages = $product->images;
        $productId = $product->id;
        $productImagesUrls = [];
        $productImagesInformations = [];

        foreach ($productImages as $key => $productImage) {
            array_push($productImagesInformations, [
                'caption' => $productImage->original_filename,

                'url' => route('products.destroyImages', ['productId' => $productId, 'imageId' => $productImage->id])
            ]);
            array_push($productImagesUrls,"/storage/media/product/".$productId."/".$productImage->filename);
        }

        return view('backend.product.add-image', compact('product', 'productId', 'productSlug', 'productImagesUrls', 'productImagesInformations'));
    }

    /**
     * Upload and save images.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveImages(Request $request, $productId)
    {
        if ($request->file('product_image')) {
            $fileData = $request->file('product_image');

            $productImage = saveFile($fileData, 'product', $productId);

            $productImage->products()->attach($productId);
        }

        $data = [
            'caption' => $productImage->original_filename,
            'url' => route('products.destroyImages', ['productId' => $productId, 'imageId' => $productImage->id])
        ];

        return response()->json([
            'initialPreview' => "/storage/media/product/".$productId."/".$productImage->filename,
            'initialPreviewConfig' => [
                $data
            ]
        ]);
    }

    /**
     * Destroy the specified image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destoryImages($productId, $imageId)
    {
        $productImage = removeFile($imageId);
        $productImage->products()->detach($productId);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::withTrashed()->where('slug', $slug)->firstOrFail();

        $expiry_periods = Product::ExpiryPeriod;
        $condition_types = Product::ConditionType;
        $time_periods = Product::TimePeriod;
        $delivery_areas = Product::DeliveryArea;
        $warranty_types = Product::WarrantyTypes;

        return view('backend.product.edit', compact('product', 'expiry_periods', 'condition_types', 'time_periods', 'delivery_areas', 'warranty_types'));
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
        $product = Product::withTrashed()->where('slug', $slug)->firstOrFail();

        //Automobiles Only
        if ($product->category->slug == 'automobiles') {
            $this->validate($request, [
                'make_year'               => 'required|numeric',
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

        //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games
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

        //Fashion-Wear Only
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
                    'is_sold'                 => request('is_sold') ? 1 : 0,
                    'status'                  => request('status') ? 1 : 0,
                    
                    //Automobiles Only
                    'kilometer_run'           => request('kilometer_run'),
                    'make_year'               => request('make_year'),
                    'color'                   => request('color'),

                    //Automobiles & Computer-Equipments & Electronics & Fashion-Wear & Mobile-Accessories
                    'manufacturer'            => request('manufacturer'),

                    //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games
                    'usedFor_period'          => request('usedFor_period'),
                    'usedFor_period_type'     => request('usedFor_period_type'),
                    'warranty_type'           => request('warranty_type'),
                    'warranty_period'         => request('warranty_period'),
                    'warranty_period_type'    => request('warranty_period_type'),

                    //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games & Food-Drinks & Pet-PetCare
                    'has_home_delivery'       => request('has_home_delivery') ? 1 : 0,
                    'delivery_area'           => request('delivery_area'),
                    'delivery_charge'          => request('delivery_charge'),

                    //Fashion-Wear Only
                    'quantity'                => request('quantity'),

                    //Fashion-Wear & Real State
                    'size'                    => request('size'),

                    //Real State Only
                    'location'                => request('location'),

                    'updated_by'              => Auth::user()->id,
                ]
            );
   
            flash('Product updated successfully.')->success();

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while updating the product.')->error();
        }

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        try {

            $product->delete();
            flash('Product deleted successfully.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the product.')->error();
        }

        return redirect(route('products.index'));
    }

    /**
     * Change the status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $slug)
    {
        $product = Product::withTrashed()->where('slug', $slug)->firstOrFail();

        try {
            $product->update(
                [
                    'status'=> request('status')
                ]
            );
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
        }
    }

    /**
     * Mark or unmark the product as sold.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markSold(Request $request, $slug)
    {
        $product = Product::withTrashed()->where('slug', $slug)->firstOrFail();

        try {
            $product->update([
                'is_sold' => request('is_sold')
            ]);

            if($product->is_sold == 1) {
                flash('Product marked as sold.')->info();
            } else {
                flash('Product marked as unsold.')->info();
            }

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Internal Error, Please try again later.')->error();
        }

        return redirect(route('products.index'));
    }

    /**
     * Mark or unmark the product as featured.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markFeatured(Request $request, $slug)
    {
        $product = Product::withTrashed()->where('slug', $slug)->firstOrFail();

        try {
            $product->update([
                'is_featured' => request('is_featured')
            ]);

            if($product->is_featured == 1) {
                $featuredProduct = [
                    'seller_name'   => $product->createdBy->name,
                    'product_title' => $product->title,
                    'product_slug' => $product->slug
                ];

                $product->createdBy->notify(new FeaturedProductNotification($featuredProduct));


                flash('Product marked as featured and message has been sent to its seller.')->info();
            } else {
                flash('Product marked as unfeatured.')->info();
            }

        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('Internal Error, Please try again later.')->error();
        }

        return redirect(route('products.index'));
    }

    /**
     * Renew the product after expried.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function renew(Request $request, $slug)
    {
        $product = Product::withTrashed()->where('expiry_period', '<', Carbon::now())->where('slug', $slug)->firstOrFail();

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
            flash('Product renewed successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while renewing the product.')->error();
        }

        return redirect(route('products.index'));
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($slug)
    {
        $product = Product::withTrashed()->where('slug', $slug)->firstOrFail();

        try {
            $product->restore();
            flash('Product restored successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while restoring the product.')->error();
        }

        return redirect(route('products.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
    }

    /**
     * Force remove the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($slug)
    {
        $product = Product::withTrashed()->where('slug', $slug)->firstOrFail();

        try {
            $product->forcedelete();
            flash('Product deleted permanently.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the product permanently.')->error();
        }

        return redirect(route('products.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
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
