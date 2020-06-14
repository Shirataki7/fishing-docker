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

    public function tweet_post()
    {   
        $user=TwitterAccount::where('user_id',Auth::id())->first();
        $fish_record=FishRecord::where('user_id',Auth::id())->orderBy('created_at', 'desc')->first();
        $twitter=new TwitterOAuth(env('TWITTER_CLIENT_ID'),env('TWITTER_CLIENT_SECRET'),
        $user->token,$user->token_secret);
        $tweet='TSURINSに釣り記録を投稿しました！'. PHP_EOL .
        $fish_record->harbor.'で'.$fish_record->fish_name.'を釣ったよ！'. PHP_EOL .
        'http://www.tsurins.com/fish_records/'.$fish_record->id. PHP_EOL .
        '#TSURINS #釣り #fishing #釣り人';
        $twitter->post('statuses/update',['status'=>$tweet]);

        return redirect()->to('fish_records');

    }
}
