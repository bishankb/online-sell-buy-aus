<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use App\Notifications\SignupVerificationNotification;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Check if user with this email exists
        $user = User::where('email', $googleUser->getEmail())->first();
        $isNewUser = false;

        if ($user) {
            // Link Google ID if not already linked
            if (!$user->google_id) {
                $user->google_id = $googleUser->getId();
                $user->avatar = $googleUser->getAvatar();
                $user->save();
            }
        } else {
            // Create new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'slug' => Str::slug($googleUser->getName()) . '-' . Str::random(5),
                'password' => bcrypt(Str::random(16)), // random password for new user
            ]);
            $isNewUser = true;
        }

        // Skip verification for Google
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user);

        if ($isNewUser) {
            $user->notify(new SignupVerificationNotification());
        }
        
        return redirect()->route('frontend.home');
    }
}