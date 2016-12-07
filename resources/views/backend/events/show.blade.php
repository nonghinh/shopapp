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
			<a href="{!! url('goto/backend/event/add')!!}" title="Add new event" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> Add new event</a>
		</div>
	</div>
	<table class="table table-striped table-hovered">
		<thead>
			<tr>
				<th>#</th>
				<th>Event name</th>
				<th>Icon</th>
				<th colspan="2">Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php $stt = 0; ?>
		@foreach($events as $event)
			<tr>
				<td>{!! ++$stt !!}</td>
				<td>{!! $event->name !!}</td>
				<td>
					<img class="table-img img-circle" src="{!! url('upload/event/'.$event->icon)!!}" alt="{!! $event->name !!}">
				</td>
				<td>
					<a href="{!! url('goto/backend/event/edit/'.$event->id)!!}" >
						<i class="fa fa-pencil fa-fw"></i> Edit
					</a>
				</td>
				<td>
					<a href="{!! url('goto/backend/event/delete/'.$event->id)!!}" onclick="return confirmDelete()" class="dangerLink">
						<i class="fa fa-trash fa-fw"></i> Delete
					</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop