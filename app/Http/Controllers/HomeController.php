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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->valid)
        {
            return redirect('select');
        }
        return view('home.index');
    }

    public function getQrcode(Google2FA $google2fa)
    {
        $user = Auth::user();
        if (!$user->secret) {
            $user->secret = $google2fa->generateSecretKey();
            $user->save();
        }

        $google2fa_url = $google2fa->getQRCodeGoogleUrl(
            'Quser',
            $user->email,
            $user->secret
        );

        $data = ['googleUrl' => $google2fa_url];

        return view('home.getQR', $data);
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
