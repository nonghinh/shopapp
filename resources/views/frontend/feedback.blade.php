@extends('layouts.master')
@section('title', 'Phản hồi')
@section('content')
	<div class="row">
		<div class="col m6 offset-m3">
			<div class="box-content z-depth-1">
				<div class="page-header">
					<h1>Phản hồi chúng tôi</h1>
				</div>
				<form action="" method="post" accept-charset="utf-8">
					{!! csrf_field() !!}
					<div class="input-field">
						<label>Họ tên <span class="required">*</span></label>
						<input type="text" name="name" value="{!! old('name') !!}" >
						@if (count($errors) > 0)
							<span class="error">{!! $errors->first('name') !!}</span>
						@endif
					</div>
					<div class="input-field">
						<label>Email <span class="required">*</span></label>
						<input type="email" name="email" value="{!! old('email') !!}" >
						@if (count($errors) > 0)
							<span class="error">{!! $errors->first('email') !!}</span>
						@endif
					</div>
					<div class="input-field">
						<label>Nội dung phản hồi <span class="required">*</span></label>
						<textarea name="content" class="materialize-textarea"></textarea>
						@if (count($errors) > 0)
							<span class="error">{!! $errors->first('content') !!}</span>
						@endif
					</div>
					<div class="input-field">
						<button type="submit" class="btn waves-effect waves-light">Gửi<i class="material-icons right">send</i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
@stop