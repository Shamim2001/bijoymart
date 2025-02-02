<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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
        $user = Socialite::driver('google')->stateless()->user();
        $this->createOrLoginUser($user, 'google');
        return redirect()->route('dashboard');
    }

    // Redirect to Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Handle Facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $this->createOrLoginUser($user, 'facebook');
        return redirect()->route('dashboard');
    }

    // Common method to create or login the user
    protected function createOrLoginUser($providerUser, $provider)
    {
        $user = User::where('email', $providerUser->getEmail())->first();

        if ($user) {
            Auth::login($user);
        } else {
            $newUser = User::create([
                'user_type'   => 'user',
                'name'        => $providerUser->getName(),
                'email'       => $providerUser->getEmail(),
                'provider_id' => $providerUser->getId(),
                'provider'    => $provider,
            ]);
            Auth::login($newUser);
        }
    }
}
