<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Zoular\Quser\QuserInterface as QI;
use Zoular\Quser2\Quser2;
class QuserTest extends TestCase
{
    private $user;
    private $quser;
    public function setUp()
    {
        parent::setUp();
        Auth::loginUsingId(99);
        $this->user = Auth::user();
        $this->quser = new Quser2();
    }
    public function testCreateQrcode()
    {
        $result = $this->quser->createQrcode();
        $this->assertTrue(is_string($result));
    }
    public function testGetQrcode()
    {
        $this->assertEquals(null, $this->quser->getQrcode(null));
        $user = $this->user;
        $this->quser->createQrcode($user);
        $shouldBe ="https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth%3A%2F%2Ftotp%2FQuser%3A". urlencode($user->email) ."%3Fsecret%3D". urlencode($user->secret) ."%26issuer%3DQuser";
        $this->assertEquals($shouldBe, $this->quser->getQrcode($user));        
    }
    public function testGetImage()
    {
        $result = $this->quser->getImage(null);
        $this->assertEquals(null, $result);
        $user = $this->user;
        $this->quser->createQrcode($user);
        $result = $this->quser->getImage($user);
        $shouldStart = starts_with($result,'data:image/png;base64,');
        $this->assertTrue($shouldStart);
    }
    public function testValidQrcode()
    {
        $user = $this->user;
        $this->assertFalse($this->quser->validQrcode($user, null));
        $result = 'storage/app/QRCode1.jpg';
        $this->assertFalse($this->quser->validQrcode($user, $result));
        $result = 'storage/app/QRCode.jpg';
        $this->assertTrue($this->quser->validQrcode($user, $result));
    }
}