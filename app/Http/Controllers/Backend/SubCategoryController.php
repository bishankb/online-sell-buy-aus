<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_sub_categories', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_sub_categories', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_sub_categories', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_sub_categories', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategory::where('sub_category_for', 'product')
                          ->categoryFilter(request('category'))
                          ->statusFilter(request('status'))
                          ->search(request('search-item'))
                          ->deletedItemFilter(request('deleted-items'))
                          ->latest()
                          ->paginate(config('product.table_paginate'));

        $categories = Category::select('title', 'slug')->get();
               
        return view('backend.sub-category.index', compact('sub_categories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('title', 'id')->get();

        return view('backend.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id.*' => 'required',
            'title.*'       => 'min:2|required|max:255|unique:sub_categories,title,NULL,id,category_id,'.$request->category_id[0],
            'status.*'      => 'nullable',
        ]);
        $titles = request('title');
        $status = request('stat');
        $categories = request('category_id');
        try {
            foreach ($titles as $key => $title) {
                SubCategory::create(
                    [
                        'sub_category_for' => 'product',
                        'category_id'      => $categories[$key],
                        'title'            => $title,
                        'slug'             => $this->setSlugAttribute($title),
                        'status'           => $status[$key],
                        'updated_by'       => Auth::user()->id,
                        'created_by'       => Auth::user()->id
                    ]
                );
            }
            flash('Sub Category(s) added successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while adding the sub category(s).')->error();
        }

        return redirect(route('sub-categories.index'));
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
    public function edit($id)
    {
        $sub_category = SubCategory::withTrashed()->find($id);
        $categories = Category::select('title', 'id')->get();

        return view('backend.sub-category.edit', compact('sub_category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        $sub_category = SubCategory::withTrashed()->find($id);
        $this->validate($request, [
            'category_id.*' => 'required',
            'title.*'       => 'min:2|required|max:255|unique:sub_categories,title,'.$id.',id,category_id,'.$request->category_id[0],
            'status.*'      => 'nullable',
        ]);
        
        $statusArray = request('status');
        $stat = isset($statusArray[0]) ? 1 : 0;

        try {
            if($sub_category->title != request('title')[0]) {
                $sub_category->update(['slug' => $this->setSlugAttribute(request('title')[0])]);
            }
            
            $sub_category->update([
                'category_id' => request('category_id')[0],
                'title' => request('title')[0],
                'status' => $stat,
                'updated_by' => Auth::user()->id,
            ]);
            
            flash('SubCategory updated successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while updating the sub category.')->error();
        }

        return redirect(route('sub-categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_category = SubCategory::find($id);

        try {
            $sub_category->delete();
            flash('SubCategory deleted successfully.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the sub_category.')->error();
        }

        return redirect(route('sub-categories.index'));
    }

    /**
     * Change the status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $sub_category = SubCategory::withTrashed()->find($id);

        try {
            $sub_category->update(
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
     * Change the home visibility of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeHomeVisibility(Request $request, $id)
    {
        $sub_category = SubCategory::withTrashed()->find($id);

        try {
            $sub_category->update(
                [
                    'home_visibility'=> request('home_visibility')
                ]
            );
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
        }
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $sub_category = SubCategory::withTrashed()->find($id);

        try {
            $sub_category->restore();
            flash('Sub Category restored successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while restoring the sub category.')->error();
        }

        return redirect(route('sub-categories.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
    }

    /**
     * Force remove the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy($id)
    {
        $sub_category = SubCategory::withTrashed()->find($id);

        try {
            $sub_category->forcedelete();
            flash('Sub Category deleted permanently.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the sub category permanently.')->error();
        }

        return redirect(route('sub-categories.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
    }

    /**
     * Creating the unique slug.
     *
     */
    private function setSlugAttribute($slug)
    {
        $slug = Str::slug($slug);
        $slugs = SubCategory::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")
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
