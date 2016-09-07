@extends('layouts.main')
@section('title', 'Show QRCode')

@section('content')
	<h1>Your QR Code</h1>
	<img class="w3-round " src="{{ $googleUrl }} ">
@endsection