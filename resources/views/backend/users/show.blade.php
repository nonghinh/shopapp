@extends('backend.app')
@section('title')
Show all user
@stop

@section('page-header')
	Show all user
@stop

@section('content')
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Username</th>
				<th>Email</th>
				<th colspan="2">Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php $stt = 0; ?>
			@foreach($users as $user)
				<tr>
					<td><?php echo ++$stt; ?></td>
					<td>{!! $user->name !!}</td>
					<td>{!! $user->email !!}</td>
					<td>
						<a href="{{ url('goto/backend/user/edit/'.$user->id) }}" title="Edit user" ><i class="fa fa-pencil fa-fw"></i> Edit</a>
					</td>
					<td >
						<a href="{{ url('goto/backend/user/delete/'.$user->id) }}" title="Delete user" class="label label-danger" onclick="return confirmDelete()"><i class="fa fa-trash fa-fw"></i> Delete</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@stop