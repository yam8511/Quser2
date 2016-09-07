@extends('layouts.main')
@section('title', 'Upload QRCode')

@section('content')
	<form enctype="multipart/form-data" action="{{ url('uploadQRCode') }}" method="post" class="w3-form" >
		{{ csrf_field() }}
		<div class="w3-input-group">
			<label class="w3-label">Upload Your QR</label>
			<input type="file" name="qrImg" class="w3-input w3-border w3-light-grey" required>
		</div>
		<button class="w3-btn w3-theme">Upload</button>
	</form>
@endsection