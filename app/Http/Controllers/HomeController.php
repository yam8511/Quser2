<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Contracts\Google2FA;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->secret && !$user->valid) {
            return redirect('select');
        }
        return view('map.index');
    }

    public function getQrcode(Google2FA $google2fa)
    {
        $user = Auth::user();
        if ($user->secret && !$user->valid) {
            return redirect('select');
        }
        
        if (!$user->secret) {
            $user->secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $google2fa_url = $google2fa->getQRCodeGoogleUrl(
            'Quser',
            $user->email,
            $user->secret
        );

        $inline_url = $google2fa->getQRCodeInline(
            'Quser',
            $user->email,
            $user->secret
        );

        $data = ['googleUrl' => $google2fa_url, 'inlineUrl' => $inline_url];

        return view('home.getQR', $data);
    }

    public function resetQrcode(Google2FA $google2fa)
    {
        $user = Auth::user();
        $user->secret = $google2fa->generateSecretKey();
        $user->save();

        return redirect('getQrcode')->with('success', 'QRCide 重設成功');
    }

    public function select()
    {
        return view('home.select');
    }

    public function logout()
    {
        $user = Auth::user();
        $user->valid = 0;
        $user->save();
        
        Auth::logout();
        return redirect('/');
    }
}
