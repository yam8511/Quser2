<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class QrcodeController extends Controller
{
    public function upload()
    {
        return view('qrcode.uploadQrcode');
    }

    public function check()
    {
        $pathToSaveFile = '../storage/app/' . $path;
        if (!$file) {
            $this->error = 2;
            return false;
        }

        if (!$id) {
            $this->error = 1;
            return false;
        }

        if($file->getExtension() != null || $file->extension() == 'img' || $file->extension() == 'png' || $file->extension() == 'jpg' || $file->extension() == 'jpeg' || $file->extension() == 'gif') {
            if(!$file->isValid()) {
                $this->error = 3;
                return false;
            }
        } else {
            $this->error = 4;
            return false;
        }

        $filename = 'qrcode_'.$id.'.png';
        $file->move($pathToSaveFile, $filename);

        $Zbar = new ZbarDecoder();
        $result = $Zbar->make($pathToSaveFile.$filename);

        //$contents = Storage::get($path.$filename);

        
        $files = Storage::disk('local')->allFiles($path);
        foreach ($files as $file) {
            Storage::delete($file);
        }

        $code = Qrcode::where('qrcode', $result->text)->first();
        if (!$code || $code->user_id != $id) {
            $this->error = 5;
            return false;
        }
    }
}
