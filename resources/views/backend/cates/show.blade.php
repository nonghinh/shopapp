@extends('backend.app')
@section('title')
Show all category
@stop
@section('page-header')
Show all category
@stop
@section('content')
	<div class="row">
		<div class="col-sm-12">
			<a href="{!! url('goto/backend/cate/add')!!}" title="Add new category" class="btn btn-default"><i class="fa fa-plus fa-fw"></i> Add new category</a>
		</div>
	</div>
	<table class="table table-striped table-hovered">
		<thead>
			<tr>
				<th>#</th>
				<th>Category name</th>
				<th>Parent category</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php $stt = 0; ?>
		@foreach($cates as $cate)
			<tr>
				<td>{!! ++$stt !!}</td>
				<td>{!! $cate->name !!}</td>
				<td>
					<?php $parent = DB::table('categories')->where('id', $cate->parent_id)->first(); ?>
					@if($parent)
					{!! $parent !!}
					@else
					{!! 'None'!!}
					@endif
				</td>
				<td>
					<a href="{!! url('goto/backend/cate/edit/'.$cate->id)!!}" class="edit" >
						<i class="fa fa-pencil fa-fw"></i> Edit
					</a>
					<a href="{!! url('goto/backend/cate/delete/'.$cate->id)!!}" onclick="return confirmDelete()" class="dangerLink delete">
						<i class="fa fa-trash fa-fw"></i> Delete
					</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
@stop