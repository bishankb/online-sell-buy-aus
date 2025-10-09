<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Notifications\SignupVerificationNotification;

class SocialController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        return $this->handleProviderCallback('google');
    }

    // Redirect to Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle Facebook callback
    public function handleFacebookCallback()
    {
        return $this->handleProviderCallback('facebook');
    }

    // Generic provider callback
    protected function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        // Check if user exists
        $user = User::where('email', $socialUser->getEmail())->first();
        $isNewUser = false;

        if ($user) {
            // Link social ID if missing
            $column = $provider . '_id';
            if (!$user->$column) {
                $user->$column = $socialUser->getId();
                $user->avatar = $socialUser->getAvatar();
                $user->save();
            }
        } else {
            // Create new user
            $user = User::create([
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                $provider.'_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'slug' => Str::slug($socialUser->getName()) . '-' . Str::random(5),
                'password' => bcrypt(Str::random(16)),
            ]);
            $isNewUser = true;
        }

        // Skip email verification
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user);

        // Send welcome notification only for new users
        if ($isNewUser) {
            $user->notify(new SignupVerificationNotification());
        }

        return redirect()->route('frontend.home');
    }
}