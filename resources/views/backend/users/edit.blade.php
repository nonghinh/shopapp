@extends('backend.app')
@section('title')
Edit user
@stop

@section('page-header')
	Edit user
@stop

@section('content')
	<form action="{!! url('goto/backend/user/edit/'.$user->id) !!}" method="post" accept-charset="utf-8">
		{!! csrf_field() !!}
		<div class="row">
			<div class="col-sm-6">
				<div class=" form-group">
					<label>User name</label>
					<input type="text" name="username" value="{{ old('username', isset($user) ? $user->name : '') }}" class="form-control">
				</div>
			</div>
			<div class="col-sm-6">
				<div class=" form-group">
					<label>Email</label>
					<input type="email" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" class="form-control">
				</div>
			</div>
			<div class="col-sm-6">
				<div class=" form-group">
					<label>Password</label>
					<input type="password" name="password" value="" class="form-control">
				</div>
			</div>
			<div class="col-sm-6">
				<div class=" form-group">
					<label>Password again</label>
					<input type="password" name="password_again" value="" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<Button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> Save</Button>
				</div>
			</div>
		</div>
	</form>
@stop