@extends('layouts.master')
@section('title', 'Thêm sự kiện')
@section('content')
	<div class="row">
		<div class="col s8 offset-s2">
			<div class="box-content z-depth-1">
				<div class="box-header">
					<h1 class="header-medium">Thêm sự kiện</h1>
				</div>
				<div class="box-body">
					<form action="" method="post" accept-charset="utf-8">
						{{ csrf_field() }}
						<div class="input-field col s12">
							<strong>Tên sự kiện<span class="required">*</span></strong>
							<input type="text" name="name" value="" placeholder="Title">
							@if (count($errors) > 0)
								<span class="error">{!! $errors->first('name') !!}</span>
							@endif
						</div>
						<div class="input-field col s12">
							<strong>Địa điểm<span class="required">*</span></strong>
							<select name="restaurant_id">
								<option value="" disabled selected>Chọn địa điểm có sự kiện</option>
						     	@foreach($rests as $rest)
									<option value="{{ $rest->id}}">{!! $rest->name !!}</option>
						     	@endforeach
						    </select>
						    @if (count($errors) > 0)
								<span class="error">{!! $errors->first('restaurant_id') !!}</span>
							@endif
						</div>
						<div class="input-field col s12">
							<strong>Danh mục<span class="required">*</span></strong>
							<select name="cate_id">
								<option value="" disabled selected>Chọn danh mục</option>
						     	@foreach($cates as $cate)
									<option value="{{ $cate->id}}">{!! $cate->name !!}</option>
						     	@endforeach
						    </select>
						    @if (count($errors) > 0)
								<span class="error">{!! $errors->first('cate_id') !!}</span>
							@endif
						</div>
						<div class="input-field col s12">
							<strong>Loại sự kiện<span class="required">*</span></strong>
							<select name="event_id">
								<option value="" disabled selected>Chọn loại sự kiện</option>
						     	@foreach($events as $event)
									<option value="{{ $event->id}}">{!! $event->name !!}</option>
						     	@endforeach
						    </select>
						    @if (count($errors) > 0)
								<span class="error">{!! $errors->first('event_id') !!}</span>
							@endif
						</div>
						
						<div class="input-field col s12">
							<strong>Thông tin chi tiết sự kiện <span class="required">*</span></strong>
							<textarea class="materialize-textarea" name="event_info"></textarea>
							@if (count($errors) > 0)
								<span class="error">{!! $errors->first('event_info') !!}</span>
							@endif
						</div>							
						<div class="input-field col s12">
							<strong>Thời gian bắt đầu <span class="required">*</span></strong>
							<input type="text" name="start_time" value="" placeholder="DD/MM/YY HH:mm (Ngày-Tháng-Năm Giờ:phút)">
							@if (count($errors) > 0)
								<span class="error">{!! $errors->first('start_time') !!}</span>
							@endif
						</div>	
						<div class="input-field col s12">
							<strong>Thời gian kết thúc <span class="required">*</span></strong>
							<input type="text" name="end_time" value="" placeholder="DD/MM/YY HH:mm ((ngày-Tháng-năm Giờ:phút))">
							@if (count($errors) > 0)
								<span class="error">{!! $errors->first('end_time') !!}</span>
							@endif
						</div>	
						<div class="row">
							<div class="col s12">
								<button type="submit" class="btn wave-effect wave-light">Xong <i class="material-icons right">check</i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Geolocation map -->
	<div id="getLocation" class="modal">
		<div class="modal-heading">
    		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat right"><i class="material-icons">clear</i></a>
    	</div>
	    <div class="modal-content">
	      <div id="geoMap" style="width:100%;height:400px;"></div>
	    </div>
	</div>
@stop