@extends('backend.app')
@section('title')
Edit event
@stop
@section('page-header')
Edit event
@stop
@section('content')
<div class="col-sm-6">
	<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<div class="form-group">
			<label>Event name</label>
			<input type="text" name="eventname" value="{{ old('eventname', isset($event) ? $event->name : '') }}" class="form-control">
		</div>
		<div class="form-group current-icon">
			<label>Current icon</label>
			<img src="{!! url('upload/event/'.$event->icon) !!}" alt="{!! $event->name !!}">
		</div>
		<div class="form-group">
			<label>Choose aother icon</label>
			<input type="file" name="eventicon" value="{{ old('eventicon')}}" class="form-control">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> Save</button>
		</div>
	</form>
</div>
@stop