@extends('layouts.master')
@section('title')
	Home
@stop
@section('content')
	<div class="row">
		<div class="col m6 offset-m3">
			<div class="box-content z-depth-1">
				<div class="page-header">
					<h1>Đăng nhập</h1>
				</div>
				@if(Session::has('error_login'))
					<div class="alert alert-warning">
						<p>{{Session::get('error_login')}}</p>
					</div>
				@endif
				<form action="" method="post" accept-charset="utf-8">
					{!! csrf_field() !!}
					<div class="input-field">
						<label>Email <span class="required">*</span></label>
						<input type="email" name="email" value="">
						@if (count($errors) > 0)
							<span class="error">{!! $errors->first('email') !!}</span>
						@endif
					</div>
					<div class="input-field">
						<label>Password<span class="required">*</span></label>
						<input type="password" name="password" value="">
						@if (count($errors) > 0)
							<span class="error">{!! $errors->first('password') !!}</span>
						@endif
					</div>
					<div class="input-field">
						<button type="submit" class="btn"><i class="material-icons right">check</i>Đăng nhập</button>
						<span class="right">Chưa có tài khoản? <a href="{!! url('/dang-ky') !!}"> Đăng ký</a></span>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop
@section('footer')
	@if(Session::has('message'))
	<script type="text/javascript">
		Materialize.toast("{{Session::get('message')}}", 4000);
	</script>
	@endif
@stop