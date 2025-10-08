<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use SEOMeta;
use OpenGraph;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        $this->seoLogin();

        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        if (auth()->check()) {
            return redirect('/');
        }
        
        return view('auth.login');  
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->active != 1) {
            auth()->logout();
            
            return redirect()->route('login')
                ->withErrors(['email' => 'Your account is not active.']);
        }
    }

    private function seoLogin()
    {
        SEOMeta::setTitle('Login through email address -'.env('APP_NAME'));
        SEOMeta::setDescription('Login through email address on '.env('APP_NAME').'. It is very easy to buy and sell your products');
        SEOMeta::setCanonical(route('login'));
        SEOMeta::addKeyword(['login', 'product', 'buy', 'sell', 'australia', 'brisbane', 'sydney', 'melbourne', 'secondhand']);
        
        OpenGraph::setTitle('Login through email address -'.env('APP_NAME'));
        OpenGraph::setDescription('Login through email address on '.env('APP_NAME').'. It is very easy to buy and sell your products');
        OpenGraph::setUrl(route('login'));
    }
}
