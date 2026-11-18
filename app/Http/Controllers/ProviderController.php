<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class ProviderController extends Controller
{
    protected  $providers = ['google'];

    public function ProviderRedirect(String $provider)
    {
        if (!in_array($provider, $this->providers)) {
            return redirect()->back();
        }
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function ProviderCallback(String $provider)
    {
        if (!in_array($provider, $this->providers)) {
            return redirect()->back();
        }
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        $user = User::updateOrCreate([
            'provider_id' => $socialUser->id,
            'provider_name' => $provider,
        ], [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'provider_token' => $socialUser->token,
            'provider_refresh_token' => $socialUser->refreshToken,
        ]);

        Auth::login($user, true);
        return redirect()->back();
    }
}
