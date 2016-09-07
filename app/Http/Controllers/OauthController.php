<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use PragmaRX\Google2FA\Contracts\Google2FA;
use Auth;

class OauthController extends Controller
{
    public function login()
    {
        return view('oauth.validate');
    }

    public function check(Request $request, Google2FA $google2fa)
    {
        $user =Auth::user();
        $secret = $request->secret;

        if(!$google2fa->verifyKey($user->secret, $secret))
        {
            $data = ['error' => '驗證失敗'];
            return redirect('passport', $data);
        }

        $user->valid = 1;
        $user->save();
        $data = ['success' => '驗證成功'];
        return redirect('/');
    }
}
