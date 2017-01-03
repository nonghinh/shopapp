@extends('layouts.master')
@section('title', '404 NOT FOUND')
@section('content')
	<div class="section">
		<div class="row">
			<div class="col s12">
				<h1 class="center teal-text">404 NOT FOUND</h1>
				<p class="center red-text">Không tìm thấy trang yêu cầu</p>
			</div>
		</div>
	</div>
	<div class="section">
		<div class="row">
			<div class="col s12">
				<a href="{!! url('/') !!}" title="home">Trở lại trang chủ</a>
			</div>
		</div>
	</div>
@stop