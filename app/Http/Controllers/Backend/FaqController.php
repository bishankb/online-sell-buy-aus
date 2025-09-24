<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Auth;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_faqs', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_faqs', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_faqs', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_faqs', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::statusFilter(request('status'))
                      ->search(request('search-item'))
                      ->deletedItemFilter(request('deleted-items'))
                      ->latest()
                      ->paginate(config('product.table_paginate'));
               
        return view('backend.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.faq.create');
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
            'faq'    => 'required|min:2|max:500|unique:faqs,faq,NULL,id',
            'answer' => 'required|min:2|max:65535',
            'status' => 'nullable',
        ]);

        try {
            $faq = Faq::create(
                [
                    'faq'          => request('faq'),
                    'slug'         => $this->setSlugAttribute(request('faq')),
                    'answer'       => request('answer'),
                    'status'       => $request->status ? 1 : 0,
                    'updated_by'   => Auth::user()->id,
                    'created_by'   => Auth::user()->id
                ]
            );
            flash('Faq added successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while adding the faq.')->error();
        }

        return redirect(route('faqs.index'));
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
        $faq = Faq::withTrashed()->find($id);

        return view('backend.faq.edit', compact('faq'));
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
        $faq = Faq::withTrashed()->find($id);

        $this->validate($request, [
            'faq'    => 'required|min:2|max:500|unique:faqs,faq,'.$faq->id.',id',
            'answer' => 'nullable|min:2|max:65535',
            'status' => 'nullable',
        ]);

        try {
            $faq->update([
                'faq'         => request('faq'),
                'answer'      => request('answer'),
                'status'      => $request->status ? 1 : 0,
                'updated_by'  => Auth::user()->id,
            ]);
            if($faq->faq != request('faq')) {
                $faq->update(['slug' => $this->setSlugAttribute(request('faq')[0])]);
            }
            flash('Faq updated successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while updating the faq.')->error();
        }

        return redirect(route('faqs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);

        try {
            $faq->delete();
            flash('Faq deleted successfully.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the faq.')->error();
        }

        return redirect(route('faqs.index'));
    }

    /**
     * Change the status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $faq = Faq::find($id);

        try {
            $faq->update(
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
        $faq = Faq::withTrashed()->find($id);

        try {
            $faq->restore();
            flash('Faq restored successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while restoring the faq.')->error();
        }

        return redirect(route('faqs.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
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
        $faq = Faq::withTrashed()->find($id);

        try {
            $faq->forcedelete();
            flash('Faq deleted permanently.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the faq permanently.')->error();
        }

        return redirect(route('faqs.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
    }

    /**
     * Creating the unique slug.
     *
     */
    private function setSlugAttribute($slug)
    {
        $slug = Str::slug($slug);
        $slugs = Faq::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")
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
