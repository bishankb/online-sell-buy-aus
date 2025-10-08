<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserProfile;
use App\Models\City;
use App\Models\Country;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Notifications\SignupVerificationNotification;
use SEOMeta;
use OpenGraph;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Overwriting the function to include city and country.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $this->seoRegister();

        $cities = City::orderBy('order', 'asc')->select('name', 'id')->get();
        $countries = Country::orderBy('order', 'asc')->select('name', 'id')->get();

        return view('auth.register', compact('cities', 'countries'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone1' => ['nullable', 'min:5', 'max:20'],
            'address' => ['nullable', 'min:2', 'max:100']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $userRoleId = Role::where('name', 'user')->first()->id;

        $user = User::create([
            'name' => $data['name'],
            'slug' => $this->setSlugAttribute(request('name')),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $userRoleId
        ]);
        $user->profile()->create([
            'phone1' => $data['phone1'],
            'address' => $data['address'],
            'city_id' => $data['city'],
            'country_id' => $data['country'],
        ]);
        
        return $user;
    }

    /**
     * Redirect url to verification.
     *
     * @param  array  $user
     */
    protected function registered(Request $request, $user)
    {
        return redirect()->route('verification.notice');
    }

    /**
     * Creating the unique slug.
     *
     */
    private function setSlugAttribute($slug)
    {
        $slug = Str::slug($slug);
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

    private function seoRegister()
    {
        SEOMeta::setTitle('Register through email address -'.env('APP_NAME'));
        SEOMeta::setDescription('Register through email address on '.env('APP_NAME').'. It is very easy to buy and sell your products');
        SEOMeta::setCanonical(route('login'));
        SEOMeta::addKeyword(['register', 'product', 'buy', 'sell', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand']);
        
        OpenGraph::setTitle('Register through email address -'.env('APP_NAME'));
        OpenGraph::setDescription('Register through email address on '.env('APP_NAME').'. It is very easy to buy and sell your products');
        OpenGraph::setUrl(route('login'));
    }
}
