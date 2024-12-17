<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function loginWithFacebook(Request $request)
    {
        return Socialite::driver('facebook')->redirect();
    }




    public function loginCallBack(Request $request)
    {
        $url = session('url');
        $user = Socialite::driver('facebook')->user();
        dd($user);


        return redirect($url)->with('login', '1');
    }








    protected function findOrCreateAccount($facebookUser)
    {
        $user = User::where('uid', $facebookUser->id)->first();

        if (!$user) {
            $user = User::create([
                'name' => $facebookUser->name,
                'uid' => $facebookUser->id,
                'avatar' => $facebookUser->avatar,
            ]);
            $user->update([
                'email' => $facebookUser->email?? 'checksca_khong_co_email_'.$user->id,
            ]);

        } else {
            User::where(
                'uid',
                $facebookUser->id
            )
                ->update([
                    'name' => $facebookUser->name,
                    'avatar' => $facebookUser->avatar,
                ]);
        }

        return $user;
    }
}
