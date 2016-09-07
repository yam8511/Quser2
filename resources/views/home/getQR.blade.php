@extends('layouts.main')
@section('title', 'Show QRCode')

@section('content')
<div class="w3-container w3-center">
	<h1>Your QR Code</h1>
	<p><a class="w3-btn w3-theme w3-round" href="{{ url('/resetQrcode') }}" onclick="event.preventDefault(); document.getElementById('resetQR-form').submit();">重設QRCode</a></p>

	<img class="w3-round" src="{{ $googleUrl }} ">
    <form id="resetQR-form" action="{{ url('/resetQrcode') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    </form>
</div>
@endsection