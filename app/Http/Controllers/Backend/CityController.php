<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_cities', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_cities', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_cities', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_cities', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderBy('order', 'asc')
                        ->search(request('search-item'))
                        ->paginate(config('product.table_paginate'));
               
        return view('backend.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.city.create');
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
            'name.*' => 'min:2|required|max:255|unique:cities,name',
            'order.*' => 'required|numeric|unique:cities,order',
        ]);
        $names = request('name');
        $orders = request('order');

        try {
            foreach ($names as $key => $name) {
                City::create(
                    [
                       'name'        => $name,
                       'order'       => $orders[$key]
                    ]
                );
            }
            flash('City(s) added successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while adding the city(s).')->error();
        }

        return redirect(route('cities.index'));
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
        $city = City::find($id);

        return view('backend.city.edit', compact('city'));
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
        $city = City::find($id);

        $this->validate($request, [
            'name.*'   => 'required|string|min:2|max:255|unique:cities,name,'.$city->id,
            'order.*'  => 'required|unique:cities,order,'.$city->id,
        ]);

        try {
            $city->update([
                'name' => request('name')[0],
                'order' => request('order')[0],
            ]);
            flash('City updated successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while updating the city.')->error();
        }

        return redirect(route('cities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);

        try {
            $city->delete();
            flash('City deleted successfully.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the city.')->error();
        }

        return redirect(route('cities.index'));
    }
}
