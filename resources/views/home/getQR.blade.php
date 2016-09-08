@extends('layouts.main')
@section('title', 'Show QRCode')

@section('content')
<div class="w3-container w3-center">
    <h1>Your QR Code</h1>
    <p>
    <a download="YourFileName.jpeg" href="data:image/jpeg;base64,iVBO...CYII="class="w3-btn w3-red w3-round"  onclick="document.getElementById('reset').style.display='block'">重設QRCode</a>
    <a class="w3-btn w3-theme w3-round" href="{{ $inlineUrl }}" download="QRCode.jpg" >下載QRCode</a>
    </p>

    <img class="w3-round" src="{{ $googleUrl }} ">
    <form id="resetQR-form" action="{{ url('/resetQrcode') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    </form>
</div>
<div id="reset" class="w3-modal">
      <div class="w3-modal-content">
        <header class="w3-container w3-pale-red">
          <span onclick="document.getElementById('reset').style.display='none'"
          class="w3-closebtn">&times;</span>
          <h2>Warning</h2>
        </header>
        <div class="w3-container">
          <h3>確定重設圖片嗎?</h3>
          <p>※重設之後，請馬上儲存圖片!</p>
          <p>※或馬上使用Google Authenticator 設定此QR!</p>
        </div>
        <footer class="w3-container w3-pale-red w3-padding">
          <button class="w3-btn w3-red w3-round" onclick="event.preventDefault(); document.getElementById('resetQR-form').submit();">確定</button>
          <button class="w3-btn w3-theme w3-round" onclick="document.getElementById('reset').style.display='none'">取消</button>
        </footer>
      </div>
    </div>
@endsection