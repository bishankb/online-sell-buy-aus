<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_categories', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_categories', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_categories', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_categories', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('category_for', 'product')
                          ->statusFilter(request('status'))
                          ->search(request('search-item'))
                          ->deletedItemFilter(request('deleted-items'))
                          ->latest()
                          ->paginate(config('product.table_paginate'));
               
        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'title.*' => 'min:2|required|max:255|unique:categories,title|distinct',
            'status.*' => 'nullable',
        ]);
        $titles = request('title');
        $status = request('stat');
        try {
            foreach ($titles as $key => $title) {
                Category::create(
                    [
                       'title'        => $title,
                       'slug'         => $this->setSlugAttribute($title),
                       'status'       => $status[$key],
                       'category_for' => 'product',
                       'updated_by'   => Auth::user()->id,
                       'created_by'   => Auth::user()->id
                    ]
                );
            }
            flash('Category(s) added successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while adding the category(s).')->error();
        }

        return redirect(route('categories.index'));
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
        $category = Category::withTrashed()->find($id);

        return view('backend.category.edit', compact('category'));
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
        $category = Category::withTrashed()->find($id);

        $this->validate($request, [
            'title.*'  => 'min:2|required|max:255|unique:categories,title,'.$category->id,
            'status.*' => 'nullable',
        ]);

        $statusArray = request('status');
        $stat = isset($statusArray[0]) ? 1 : 0;

        try {
            if($category->title != request('title')) {
                $category->update(['slug' => $this->setSlugAttribute(request('title')[0])]);
            }
            
            $category->update([
                'title' => request('title')[0],
                'status' => $stat,
                'updated_by' => Auth::user()->id,
            ]);
            
            flash('Category updated successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while updating the category.')->error();
        }

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        try {
            $category->delete();
            flash('Category deleted successfully.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the category.')->error();
        }

        return redirect(route('categories.index'));
    }

    /**
     * Change the status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $category = Category::withTrashed()->find($id);

        try {
            $category->update(
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
     * Restore the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);

        try {
            $category->restore();
            flash('Category restored successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while restoring the category.')->error();
        }

        return redirect(route('categories.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
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
        $category = Category::withTrashed()->find($id);

        try {
            $category->forcedelete();
            flash('Category deleted permanently.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the category permanently.')->error();
        }

        return redirect(route('categories.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
    }

    /**
     * Creating the unique slug.
     *
     */
    private function setSlugAttribute($slug)
    {
        $slug = Str::slug($slug);
        $slugs = Category::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")
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
