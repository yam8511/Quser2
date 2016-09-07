<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Storage;
use PragmaRX\Google2FA\Contracts\Google2FA;
use RobbieP\ZbarQrdecoder\ZbarDecoder;

class QrcodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function upload()
    {
        return view('qrcode.uploadQrcode');
    }

    public function check(Request $request)
    {
        $path = 'qrcodes/';
        $file = $request->qrImg;
        $pathToSaveFile = '../storage/app/' . $path;
        $user = Auth::user();

        if (!$file) {
            return redirect('uploadQRCode')->with('error', '請上傳 QRCode!');
        }

        $filename = 'qrcode_'.$user->id.'.png';
        $file->move($pathToSaveFile, $filename);

        $Zbar = new ZbarDecoder();
        $result = $Zbar->make($pathToSaveFile.$filename);
        
        $files = Storage::disk('local')->allFiles($path);
        foreach ($files as $file) {
            Storage::delete($file);
        }
        if(!str_contains($result->text, $user->secret))
        {
            return redirect('uploadQRCode')->with('error', 'QRCode 無效!');
        }

        $user->valid = 1;
        $user->save();
        return redirect('/')->with('success', '驗證成功');
    }
}
