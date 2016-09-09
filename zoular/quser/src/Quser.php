<?php 

namespace Zoular\Quser;

use Zoular\Quser\QuserInterface;
use PragmaRX\Google2FA\Google2FA;
use RobbieP\ZbarQrdecoder\ZbarDecoder;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Storage;

/**
* Quser
*/
class Quser implements QuserInterface
{
    private $google2fa = null;
    private $decoder = null;

    public function __construct()
    {
        $this->google2fa = new Google2FA;
        $this->decoder = new ZbarDecoder;
    }

    public function createQrcode()
    {
        $secret = $this->google2fa->generateSecretKey();
        return $secret;
    }

    public function getQrcode($user)
    {
        if (!$user || !$user->secret) {
            return null;
        }

        $result = $this->google2fa->getQRCodeGoogleUrl(
            'Quser',
            $user->email,
            $user->secret
        );

        return $result;
    }

    public function getImage($user)
    {
        if (!$user || !$user->secret) {
            return null;
        }

        return $this->google2fa->getQRCodeInline(
            'Quser',
            $user->eamil,
            $user->secret
        );
    }

    public function validQrcode($user, $file)
    {
        if (!$user|| !$user->secret || !$file) {
            return false;
        }
        
        $result = $this->decoder->make($file);
        Storage::delete($file);

        if(!str_contains($result->text, $user->secret))
        {
            return false;
        }

        return true;
    }
}
