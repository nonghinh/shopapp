@extends('layouts.master')
@section('title')
	Home
@stop
@section('content')
	<div class="row">
		<div class="col m6 offset-m3">
			<div class="box-content z-depth-1">
				<div class="page-header">
					<h1>Đăng ký</h1>
				</div>
				<form action="" method="post" accept-charset="utf-8">
					{!! csrf_field() !!}
					<div class="input-field">
						<label>Tên tài khoản <span class="required">*</span></label>
						<input type="text" name="username" value="">
						@if (count($errors) > 0)
							<span class="error">{!! $errors->first('username') !!}</span>
						@endif
					</div>
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
						<label>Re-password<span class="required">*</span></label>
						<input type="password" name="repassword" value="">
						@if (count($errors) > 0)
							<span class="error">{!! $errors->first('repassword') !!}</span>
						@endif
					</div>
					<div class="input-field">
						<button type="submit" class="btn"><i class="material-icons right">check</i>Xong</button>
						<span class="right">Đã có tài khoản? <a href="{!! url('/dang-nhap') !!}"> Đăng nhập</a></span>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop