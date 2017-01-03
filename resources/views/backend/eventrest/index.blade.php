@extends('backend.app')
@section('title')
Show all events
@stop
@section('page-header')
Show all events
@stop
@section('content')
	<div class="row">
		<div class="col-sm-12">
			<a href="{!! url('them-su-kien')!!}" title="Add new event" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> Add new event restaurant</a>
		</div>
	</div>
	<table class="table table-striped table-hovered">
		<tr>
			<th>#</th>
			<th>Eventname</th>
			<th>Location</th>
			<th>Time</th>
			<th>Action</th>
		</tr>
		@if($eventR)
			<?php $stt = 0; ?>
		@foreach($eventR as $item)
			<tr>
				<td>{{ ++$stt }}</td>
				<td>{{ $item->name }}</td>
				<td>
					<?php $loc = DB::table('restaurants')->where('id', $item->restaurant_id)->first(); ?>
					{{ $loc->name }}
				</td>
				<td></td>
				<td>
					<a href="{{url('update-su-kien/'.$item->slug.'/'.$item->id)}}" class="edit"><i class="fa fa-pencil"></i> Edit</a>
					
					<a href="{{ url('xoa-su-kien/'.$item->slug.'/'.$item->id) }}" onclick="return confirmDelete()" class="delete"><i class="fa fa-trash"></i> Delete</a>
				</td>
			</tr>
		@endforeach
		@else
		<strong class="text-center">No data</strong>
		@endif
	</table>
@stop