<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\FishRecord;
use App\Models\TwitterAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use InvalidArgumentException;


class OAuthLoginController extends Controller
{
    public function getTwitterAuth()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function authTwitterCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();
            $twitter_user = new TwitterAccount;
            $twitter_user->user_id = Auth::id();
            $twitter_user->twitter_id = $user->getID();
            $twitter_user->token = $user->token;
            $twitter_user->token_secret = $user->tokenSecret;

            $twitter_user->save();

            return redirect()->route('tweet');
        } catch (InvalidArgumentException $e) {
            return redirect()->to('/fish_records');
        }
    }
}
