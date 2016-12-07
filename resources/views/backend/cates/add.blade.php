@extends('backend.app')
@section('title')
Add category
@stop
@section('page-header')
Add category
@stop
@section('content')
	<div class="col-md-6">
		<form action="" method="post" accept-charset="utf-8">
		{{ csrf_field() }}
			<div class="form-group">
				<label>Parent catetegory</label>
				<select name="parent_id" class="form-control">
					<option value="0">--None--</option>
					 {!! getParentCate($cates) !!}
				</select>
			</div>
			<div class="form-group">
				<label>Catename</label>
				<input type="text" name="catename" value="{{ old('catename')}}" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> Save</button>
			</div>
			</div>
		</form>
	</div>
@stop