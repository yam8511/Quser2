@extends('layouts.main')
@section('title', 'Google Map')

@section('content')
<style type="text/css">
	#map{
		min-height: 430px;
	}
</style>

	<div id="map" class="w3-container w3-round"></div>
    
    <div id="searchBar" class="w3-container w3-margin">
	    <input type="text" name="address" placeholder="輸入位置" id="pac-input" class="w3-border w3-round w3-hover-border-blue w3-large">
    	<button id="search" class="w3-btn w3-btn-floating w3-pale-blue"><i class="fa fa-search"></i></button>
    	<button class="w3-btn w3-btn-floating w3-pale-red" onclick="display()"><i class="fa fa-pencil"></i></button>
    	<button class="w3-btn w3-btn-floating w3-pale-yellow" onclick="clean()"><i class="fa fa-eraser"></i></button>
    </div>
    <div id="message"></div>

	<!-- Add Google Map -->
	<script src="{{ url('js/myMap.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdTOoG8K8TwIgt-GxqQRxN_RqW9euRjIE&signed_in=true&libraries=places&callback=initMap" async defer></script>

@endsection