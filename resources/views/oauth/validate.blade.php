@extends('layouts.main')
@section('title', 'Oauth Validate')

@section('content')
	<form action="{{ url('passport') }}" method="post" class="w3-form" >
		{{ csrf_field() }}
		<div class="w3-input-group">
			<label class="w3-label">驗證碼</label>
			<input type="text" name="secret" class="w3-input w3-border" placeholder="輸入驗證碼" required>
		</div>
		<button class="w3-btn w3-theme">驗證</button>
	</form>
@endsection