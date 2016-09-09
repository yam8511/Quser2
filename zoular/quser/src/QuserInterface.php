<?php

namespace Zoular\Quser;

interface QuserInterface
{
	public function createQrcode();
	public function getQrcode($user);
	public function getImage($user);
	public function validQrcode($user, $file);
}
