@extends('layouts.master')
@section('title')
	Thêm địa điểm
@stop
@section('content')
	<div class="row">
		<div class="col s8 offset-s2">
			<div class="box-content z-depth-1 lager-box">
				<div class="box-header">
					<h1 class="header-medium">Thêm địa điểm</h1>
					<p>Những địa điểm yêu thích của bạn có thể chưa có trên livetoeat, thêm ngay nào!</p>
				</div>
				<div class="box-body">
						<div class="infoHeading">
						<h3>Thông tin cơ bản</h3>
					</div>
					<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="input-field col s12">
							<label>Tên địa điểm<span class="required">*</span></label>
							<input type="text" name="name" value="">
							@if (count($errors) > 0)
								<span class="error">{!! $errors->first('name') !!}</span>
							@endif
						</div>
						<div class="input-field col s12">
							<label>Địa chỉ<span class="required">*</span></label>
							<input type="text" name="address" value="">
							@if (count($errors) > 0)
								<span class="error">{!! $errors->first('address') !!}</span>
							@endif

							@if(Session::has('error_address'))
								<span class="error">{!! Session::get('error_address') !!}</span>
							@endif
						</div>
						<div class="file-field input-field col s12">
					      <div class="btn">
					        <span>Ảnh mô tả</span>
					        <input type="file" name="cover_image" value="">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text">
					      </div>
					      	@if (count($errors) > 0)
								<span class="error">{!! $errors->first('cover_image') !!}</span>
							@endif
					    </div>
						<div class="input-field col s12">
							<label>Điện thoại</label>
							<input type="tel" name="phone" value="">
						</div>
						<div class="input-field col s12">
							<label>Email</label>
							<input type="email" name="email" value="">
						</div>
						<div class="input-field col s12">
							<label>Website</label>
							<input type="text" name="website" value="">
						</div>
						<div class="input-field col s12">
							<textarea class="materialize-textarea" name="description_place"></textarea>
					        <label>Mô tả chi tiết địa điểm</label>
						</div>
						<div class="col s12">
							<label>Cập nhật vị trí</label>
							<input type="hidden" name="location" id="location" value="">
							 <a href="javascript:void(0)" id="btnGeo" class="btn-floating btn-large waves-effect waves-light teal" onclick="Materialize.toast('Di chuyển điểm đánh dấu đến địa điểm mong muốn', 4000)"><i class="material-icons">edit_location</i></a>
							 <span id="locate">00.00, 00.00</span>
						</div>
						<div class="infoHeading">
							<h3>Thông tin thêm</h3>
						</div>
						<div class="input-field col s12">
							<label>Sức chứa</label>
							<input type="number" name="capacity" value="0">
						</div>
						<div class="row">
							<div class="input-field col s12">
							    <select name="opentime_hours" class="col s6">
							     	@for($i = 0; $i < 24; $i++)
										@if($i < 10)
											<option value="{{ '0'.$i}}">{!! '0'.$i !!}</option>
										@else
											<option value="{{ $i }}">{!! $i !!}</option>
										@endif
							     	@endfor
							    </select>
							    <select name="opentime_minute" class="col s6">
							     	@for($i = 0; $i < 60; $i+=15)
							     		@if($i== 0)
							     			<option value="{{ '0'.$i }}">{!! '0'.$i !!}</option>
							     		@else
											<option value="{{ $i }}">{!! $i !!}</option>
										@endif
							     	@endfor
							    </select>
							    <label>Thời gian mở cửa</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
							    <select name="closetime_hours" class="col s6">
							     	@for($i = 0; $i < 24; $i++)
										@if($i < 10)
											<option value="{{ '0'.$i}}">{!! '0'.$i !!}</option>
										@else
											<option value="{{ $i }}">{!! $i !!}</option>
										@endif
							     	@endfor
							    </select>
							    <select name="closetime_minute" class="col s6">
							     	@for($i = 0; $i < 60; $i+=15)
							     		@if($i== 0)
							     			<option value="{{ '0'.$i }}">{!! '0'.$i !!}</option>
							     		@else
											<option value="{{ $i }}">{!! $i !!}</option>
										@endif
							     	@endfor
							    </select>
							    <label>Thời gian đóng cửa</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
							    <select name="last_order_time_hours" class="col s6">
							     	@for($i = 0; $i < 24; $i++)
										@if($i < 10)
											<option value="{{ '0'.$i}}">{!! '0'.$i !!}</option>
										@else
											<option value="{{ $i }}">{!! $i !!}</option>
										@endif
							     	@endfor
							    </select>
							    <select name="last_order_time_minute" class="col s6">
							     	@for($i = 0; $i < 60; $i+=15)
							     		@if($i== 0)
							     			<option value="{{ '0'.$i }}">{!! '0'.$i !!}</option>
							     		@else
											<option value="{{ $i }}">{!! $i !!}</option>
										@endif
							     	@endfor
							    </select>
							    <label>Thời gian đặt hàng cuối cùng trong ngày</label>
							</div>
						</div>

						<div class="input-field col s12">
							<label>Giá thấp nhất</label>
							<input type="number" name="min_price" value="0">
						</div>
						<div class="input-field col s12">
							<label>Giá Cao nhất</label>
							<input type="number" name="min_price" value="0">
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
		
	    <div class="modal-content">
	      <div id="geoMap" style="width:100%;height:400px;"></div>
	    </div>
	</div>
@stop