@extends('layouts.main')
@section('title', 'Validate')

@section('content')
	<div class="w3-row-padding">
		<div class="w3-col s6" >
			<div class="w3-container w3-center" >
				<a class="w3-btn w3-blue w3-xxlarge" style="width: 100%;" href="{{ url('uploadQRCode') }}"><p>QR Code</p></a>
			</div>
		</div>
		<div class="w3-col s6">
			<div class="w3-container w3-center">
				<a class="w3-btn w3-yellow w3-xxlarge" style="width: 100%;" href="{{ url('passport') }}"><p>OAuth</p></a>
			</div>
		</div>
	</div>
@endsection