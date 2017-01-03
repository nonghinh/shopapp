@extends('backend.app')
@section('title', 'Show all restaurants (locations)')

@section('page-header', 'Show all restaurants (locations)')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<a href="{!! url('them-dia-diem')!!}" title="Add new restaurant" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> Add new restaurant</a>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Address</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Website</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php $stt = 0; ?>
			@foreach($rests as $rest)
				<tr>
					<td><?php echo ++$stt; ?></td>
					<td>{!! $rest->name !!}</td>
					<td>{!! $rest->address !!}</td>
					<td>{!! $rest->email !!}</td>
					<td>{!! $rest->phone !!}</td>
					<td>{!! $rest->website !!}</td>
					<td>
						<a href="{{ url('update-dia-diem/'.$rest->slug.'/'.$rest->id) }}" title="Edit restaurant" class="edit"><i class="fa fa-pencil fa-fw"></i> Edit</a>
						<a href="{{ url('xoa-dia-diem/'.$rest->slug.'/'.$rest->id) }}" title="Delete restaurant" class="delete" onclick="return confirmDelete()"><i class="fa fa-trash fa-fw"></i> Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop