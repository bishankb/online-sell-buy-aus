<?php

namespace App\Http\Controllers\Frontend\UserAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Product;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\BuyerQuestion;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Hash;
use SEOMeta;
use OpenGraph;

class AccountController extends Controller
{
    public function index()
    {
        $this->seoIndex();

        $totalProduct = Product::where('created_by', Auth::user()->id)->count();
        $savedProduct = Auth::user()->savedProducts()->count();
        $activeProduct = Product::where('created_by', Auth::user()->id)->where('expiry_period', '>', Carbon::now())->where('is_sold', 0)->count();
        $soldProduct = Product::where('created_by', Auth::user()->id)->where('is_sold', 1)->count();
        $expiredProduct = Product::where('created_by', Auth::user()->id)->where('expiry_period', '<', Carbon::now())->count();
        $newBuyerMessageCount = BuyerQuestion::where('asked_by', '!=', Auth::user()->id)
                                        ->where('answer', null)
                                        ->whereHas('product', function ($query) {
                                            $query->where('created_by', Auth::user()->id)
                                                ->where('status', 1)
                                                ->where('expiry_period', '>', Carbon::now());
                                        })->count();

        $newSellerReplyCount = BuyerQuestion::where('asked_by', Auth::user()->id)
                                        ->where('answer', '!=', null)
                                        ->where('is_read', 0)
                                        ->whereHas('product', function ($query) {
                                            $query->where('status', 1)
                                                  ->where('expiry_period', '>', Carbon::now());
                                        })->count();

        $newAdminSellerReplyCount = BuyerQuestion::where('asked_by', Auth::user()->id)
                                        ->where('answer2', '!=', null)
                                        ->where('is_read', 0)
                                        ->whereHas('product', function ($query) {
                                            $query->where('status', 1)
                                                  ->where('expiry_period', '>', Carbon::now());
                                        })->count();

        return view('frontend.user-dashboard.dashboard', compact('totalProduct', 'savedProduct', 'activeProduct', 'soldProduct', 'expiredProduct', 'newBuyerMessageCount', 'newSellerReplyCount', 'newAdminSellerReplyCount'));
    }

    public function showProfile()
    {
        $this->seoShowProfile();

        $user = Auth::user();
        $userProfile = Auth::user()->profile;
        $cities = City::get();
        $countries = Country::get();

        return view('frontend.user-dashboard.account.profile', compact('user', 'userProfile', 'cities', 'countries'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $this->validate(
            $request,
            [
                'name'        => 'required|max:255',
                'phone1'      => 'nullable|min:5|max:20',
                'phone2'      => 'nullable|min:5|max:20',
                'address'     => 'nullable|min:2|max:100',
                'city'        => 'nullable',
                'country'     => 'nullable',
                'user_image'  => 'nullable|image|mimes:jpg,png,jpeg|max:10240'
            ]
        );

        try {
             if ($request->file('user_image')) {
                $fileData = $request->file('user_image');
                $user_image = saveFile($fileData, 'user', $user->id);
            }

            if(isset($user_image->id) && !empty($user->profile->user_image_id)) {
                removeFile($user->profile->user_image_id);
            }

            if (!$user->profile) {
                $userProfile = UserProfile::create(
                    [
                        'user_id'       => $user->id,
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
                        'phone1'        => request('phone1'),
                        'phone2'        => request('phone2'),
                        'address'       => request('address'),
                        'city_id'       => request('city'),
                        'country_id'    => request('country'),  
                    ]
                );
            }

            Auth::user()->update([
                'name' => request('name'),
            ]);

            $notification = array(
                'success'    => 'Profile updated successfully.',
            );
            
            flash('Profile updated successfully.')->success();
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());

            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }

        return redirect()->route('my-account.showProfile')->with($notification);
    }

    /**
     * Remove the specified image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyImage()
    {
        $userProfile = Auth::user()->profile;

        try {
            removeFile($userProfile->user_image_id);

            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
        }
    }

    public function changePassword()
    {
        $this->seoChangePassword();

        return view('frontend.user-dashboard.account.change-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $this->validate(
            $request,
            [
                'password' => 'required|string|min:6|confirmed'
            ]
        );

        try {
             $user->update(
                [
                    'password' => Hash::make(request('password'))
                ]
            );

            $notification = array(
                'success'    => 'Password changed successfully.',
            );
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            
            $notification = array(
                'error'    => 'Internal Error, Please try again later.',
            );
        }        

        return redirect()->route('my-account.changePassword')->with($notification);
    }

    private function seoIndex()
    {
        SEOMeta::setTitle(Auth::user()->name."'s Dashboard -".env("APP_NAME"));
        SEOMeta::setDescription(env('APP_NAME').' - View the number of your total products for sell, your sold products, new message from buyer, new reply from sellers as well as your membership date.');
        SEOMeta::setCanonical(route('my-account.index'));
        SEOMeta::addKeyword(['osbaustralia', 'userDashboard', 'total-product-quantity', 'sold-product-quantity', 'buyer-message', 'seller-reply', 'membership-date', 'buy', 'sell', 'brand', 'new', 'used', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand', 'cheap', 'popular', 'product']);
        
        OpenGraph::setTitle(Auth::user()->name."'s Dashboard -".env("APP_NAME"));
        OpenGraph::setDescription(env('APP_NAME').' - View the number of your total products for sell, your sold products, new message from buyer, new reply from sellers as well as your membership date.');
        OpenGraph::setUrl(route('my-account.index'));
    }

    private function seoShowProfile()
    {
        SEOMeta::setTitle(Auth::user()->name."'s Profile -".env("APP_NAME"));
        SEOMeta::setDescription(env('APP_NAME').' - Update your profile. Edit name, phone number, address, city, country and insert your profile picture.');
        SEOMeta::setCanonical(route('my-account.showProfile'));
        SEOMeta::addKeyword(['osbaustralia', 'profile', 'name', 'phone-number', 'address', 'city', 'country', 'profile-picture', 'buy', 'sell', 'brand', 'new', 'used', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand', 'cheap', 'popular', 'product']);
        
        OpenGraph::setTitle(Auth::user()->name."'s Profile -".env("APP_NAME"));
        OpenGraph::setDescription(env('APP_NAME').' - Update your profile. Edit name, phone number, address, city, country and insert your profile picture.');
        OpenGraph::setUrl(route('my-account.showProfile'));
    }

    private function seoChangePassword()
    {
        SEOMeta::setTitle(Auth::user()->name."'s Password -".env("APP_NAME"));
        SEOMeta::setDescription(env('APP_NAME').' - Update your old password. Choose the strong password for making your account secure.');
        SEOMeta::setCanonical(route('my-account.changePassword'));
        SEOMeta::addKeyword(['osbaustralia', 'password', 'buy', 'sell', 'brand', 'new', 'used', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand', 'cheap', 'popular', 'product']);
        
        OpenGraph::setTitle(Auth::user()->name."'s Password -".env("APP_NAME"));
        OpenGraph::setDescription(env('APP_NAME').' - Update your old password. Choose the strong password for making your account secure.');
        OpenGraph::setUrl(route('my-account.changePassword'));
    }
}
