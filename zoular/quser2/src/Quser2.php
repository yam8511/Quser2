<?php 

namespace Zoular\Quser2;

use Zoular\Quser2\QuserInterface;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;
use RobbieP\ZbarQrdecoder\ZbarDecoder;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Storage;

/**
* Quser
*/
class Quser2 implements QuserInterface
{
    private $encoder = null;
    private $decoder = null;

    public function __construct()
    {
        $this->encoder = new BaconQrCodeGenerator;
        $this->decoder = new ZbarDecoder;
    }

    public function createQrcode()
    {
        $google2fa = new Google2FA;
        $secret = $google2fa->generateSecretKey();
        return $secret;
    }

    public function getQrcode($user)
    {
        if (!$user || !$user->secret) {
            return null;
        }

        $google2fa = new Google2FA;
        $result = $google2fa->getQRCodeGoogleUrl(
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

        return 'data:image/png;base64,'.base64_encode($this->encoder->format('png')->size(200)->generate($user->secret));
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
