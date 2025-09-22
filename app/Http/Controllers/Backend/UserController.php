<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Media;
use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view_users', ['only' => ['index', 'show']]);
        $this->middleware('permission:add_users', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_users', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_users', ['only' => 'destroy']);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $redirectTo = '/login';

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::statusFilter(request('status'))
                        ->search(request('search-item'))
                        ->cityFilter(request('city'))
                        ->roleFilter(request('role'))
                        ->deletedItemFilter(request('deleted-items'))
                        ->latest()
                        ->paginate(config('product.table_paginate'));
                        
        $cities = City::select('name')->get();
        $roles = Role::select('name', 'display_name')->get();
                        
        return view('backend.user.index', compact('users', 'cities', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'     => 'required|string|min:2|max:255',
                'email'    => 'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|string|min:6|confirmed'
            ]
        );

        try {
            $user = User::create(
                [
                    'name'     => request('name'),
                    'slug'     => $this->setSlugAttribute(request('name')),
                    'email'    => request('email'),
                    'password' => Hash::make(request('password'))
                ]
            );
            flash('User added successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while adding the user.')->error();
        }

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::withTrashed()->find($id);
        $userProfile = UserProfile::where('user_id', $id)->first();
        $roles = Role::get();
        $cities = City::orderBy('order', 'asc')->select('name', 'id')->get();
        $countries = Country::orderBy('order', 'asc')->select('name', 'id')->get();

        return view('backend.user.edit', compact('user', 'userProfile', 'roles', 'cities', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::withTrashed()->find($id);

        if(Auth::user()->hasRole('admin')) {
            $this->validate(
                $request,
                [
                    'name'    => 'required|string|min:2|max:255',
                    'email'   => 'required|string|email|max:255|unique:users,email,'.$id.',id,deleted_at,NULL',
                    'role'    => 'required'
                ]
            );
        } elseif (Auth::user()->id == $user->id) {
            $this->validate(
                $request,
                [
                    'name'    => 'required|string|min:2|max:255',
                    'email'   => 'required|string|email|max:255|unique:users,email,'.$id.',id,deleted_at,NULL',
                ]
            );
        } else {
            $this->validate(
                $request,
                [
                    'name'    => 'required|string|min:2|max:255',
                ]
            );
        }

        try {
            if(Auth::user()->hasRole('admin')) {
                if($user->name != request('name')) {
                    $user->update(['slug' => $this->setSlugAttribute(request('name'))]);
                }

                $user->update(
                    [
                        'name'    => request('name'),
                        'email'   => request('email'),
                        'role_id' => request('role'),
                    ]
                );
                $role = request('role');
                $user->syncRoles($role);
            } elseif (Auth::user()->id == $user->id) {
                if($user->name != request('name')) {
                    $user->update(['slug' => $this->setSlugAttribute(request('name'))]);
                }

                $user->update(
                    [
                        'name'    => request('name'),
                        'email'   => request('email')
                    ]
                );
            } else {
                if($user->name != request('name')) {
                    $user->update(['slug' => $this->setSlugAttribute(request('name'))]);
                }

                $user->update(
                    [
                        'name'    => request('name'),
                    ]
                );
            }
            flash('User added successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while adding the user.')->error();
        }

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        try {
            $user->delete();
            flash('User deleted successfully.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the user.')->error();
        }

        return redirect(route('users.index'));
    }

    /**
     * Change the status of specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $user = User::withTrashed()->find($id);

        try {
            $user->update(
                [
                    'active'=> request('status')
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
        $user = User::withTrashed()->find($id);
        
        $users = User::withTrashed()->where('email', $user->email)->get();

        try {
            if(count($users) > 1) {
                flash('Email with '. $user->email . 'already exists. Please rename the email before restoring.')->error();
                return redirect(route('users.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
            }
            
            $user->restore();
            flash('User restored successfully.')->info();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while restoring the user.')->error();
        }

        return redirect(route('users.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
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
        $user = User::withTrashed()->find($id);

        try {
            $user->forcedelete();
            flash('User deleted permanently.')->error();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while deleting the user permanently.')->error();
        }

        return redirect(route('users.index', ['filter_by' => 'deleted-items', 'deleted-items' => 'Only Deleted']));
    }

    /**
     * Edit the profile of the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request, $id)
    {
        $user = User::withTrashed()->find($id);

        $validator = Validator::make($request->all(), [
            'phone1'      => 'nullable|min:5|max:20',
            'phone2'      => 'nullable|min:5|max:20',
            'address'     => 'nullable|min:2|max:100',
            'city'        => 'nullable',
            'country'     => 'nullable',
            'user_image'  => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);
         
        if ($validator->fails()) {
            return redirect(route('users.edit', [$user->id]). '#profile')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if ($request->file('user_image')) {
                $fileData = $request->file('user_image');
                $user_image = saveFile($fileData, 'user', $id);
            }

            if(isset($user_image->id) && !empty($user->profile->user_image_id)) {
                removeFile($user->profile->user_image_id);
            }

            if (!$user->profile) {
                $userProfile = UserProfile::create(
                    [
                        'user_id'       => $id,
                        'phone1'        => request('phone1'),
                        'phone2'        => request('phone2'),
                        'address'       => request('address'),
                        'city_id'       => request('city'),
                        'country_id'    => request('country'),
                        'user_image_id' => isset($user_image->id) ? $user_image->id : null
                    ]
                );
            } else {
                if (isset($user_image->id)) {
                    $user->profile->update(['user_image_id' => $user_image->id]);
                }
                $user->profile->update(
                    [
                        'user_id'       => $id,
                        'phone1'        => request('phone1'),
                        'phone2'        => request('phone2'),
                        'address'       => request('address'),
                        'city_id'       => request('city'),
                        'country_id'    => request('country'),  
                    ]
                );
            }
            flash('Profile updated successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while updating the profile.')->error();
        }

        return redirect(route('users.index'));
    }

    /**
     * Change the password of the user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request, $id)
    {
        $user = User::withTrashed()->find($id);

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed'
        ]);
         
        if ($validator->fails()) {
            return redirect(route('users.edit', [$user->id]). '#change-password')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if (!(Auth::user()->id == $user->id || Auth::user()->role->name == 'admin')) {
                flash('You dont have authorization to change the password')->error();
                return redirect()->route('users.index');
            } else {
                $user->update(
                    [
                        'password' => Hash::make(request('password'))
                    ]
                );
                flash('Password changed successfully.')->success();
            }
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            flash('There was some intenal error while changing the password.')->error();
        }        

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyImage($id)
    {
        $user = User::withTrashed()->find($id);

        try {
            removeFile($user->profile->user_image_id);

            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());    
        }

    }


    /**
     * Creating the unique slug.
     *
     */
    private function setSlugAttribute($slug)
    {
        $slug = str_slug($slug);
        $slugs = User::whereRaw("slug RLIKE '^{$slug}(-[0-9]*)?$'")
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
