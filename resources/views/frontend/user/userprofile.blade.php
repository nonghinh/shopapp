@extends('layouts.master')
@section('title', 'Thông tin cá nhân')
@section('content')
	<div id="content-user">
		<div class="heading">
			<h1>Thông tin cá nhân</h1>
		</div>
		<div class="row">
			<div class="col m12">
				<div class="userInfo">
					<ul class="collection with-header">
				        <li class="collection-header center"><h4>Tài khoản</h4></li>
				        <li class="collection-item"><strong>Tên tài khoản: </strong> <span class="account">{{ $user->name}}</span> <a href="javascript:void(0)" class="secondary-content" id="edit-account"><i class="material-icons">mode_edit</i></a></li>
				        <li class="collection-item"><strong>Email: </strong><span class="email">{{ $user->email }}</span> <a href="javascript:void(0)" class="secondary-content" id="edit-email"><i class="material-icons">mode_edit</i></a></li>
				        <li class="collection-item"><strong>Mật khẩu: </strong>***** <a href="javascript:void(0)" class="secondary-content" id="edit-password"><i class="material-icons">mode_edit</i></a></li>
				        <li class="collection-item"><strong>Tham gia vào:</strong> {{ $user->created_at}} </li>
				        <li class="collection-item"><strong>Cập nhật gần nhất:</strong> {{ $user->updated_at}}</li>
				    </ul>
				</div>
				<div class="divider"></div>
				<div class="userRest">
					<h4 class="center">Danh sách địa điểm</h4>
					@if($rests)
					<div class="basicinfo row">
						<div class="col s8">
							<p class="truncate" class="left">Có <strong class="blue-text">{{ $rests->count() }} </strong> địa điểm bạn đã thêm</p>
						</div>
						<div class="col s4"><p><a href="{{ url('/ds-su-kien') }}" class="right">Xem danh sách sự kiện >></a></p></div>
					</div>
					<table class="bordered striped highlight white z-depth-1">
						<tr>
							<th>#</th>
							<th>Địa điểm</th>
							<th>Địa chỉ</th>
							<th>Email</th>
							<th>Điện thoại</th>
							<th>Website</th>
							<th>Hoạt động</th>
						</tr>
						<?php $stt = 0; ?>
						@foreach($rests as $rest)
						<tr>
							<td>{{ ++$stt }}</td>
							<td>{{ $rest->name}}</td>
							<td>{{ $rest->address}}</td>
							<td>{{ $rest->email}}</td>
							<td>{{ $rest->phone}}</td>
							<td>{{ $rest->website}}</td>
							<td>
								<a href="{!! url('update-dia-diem/'.$rest->slug.'/'.$rest->id) !!}" title="Sửa" class="blue-text"><i class="material-icons">mode_edit</i></a>
								&nbsp;
								<a href="{!! url('xoa-dia-diem/'.$rest->slug.'/'.$rest->id) !!}" title="Xóa" class="red-text" onclick="return confirmDelete()"><i class="material-icons">remove_circle</i></a>
								<?php 
									$now = Carbon\Carbon::now();
									$eventR = DB::table('event_restaurant')->where('restaurant_id', $rest->id)->where('start_time', '<=', $now)->where('end_time', '>', $now)->first();
									?>
								@if($eventR)
								&nbsp;
								<a href="{!! url('ds-su-kien')!!}" title="Đang có sự kiện" class="pink-text"><i class="material-icons">card_giftcard</i></a>
								@endif
							</td>
						</tr>
						@endforeach
					</table>
					@else
						<strong>Chưa có địa điểm nào được thêm từ bạn</strong>
					@endif
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Structure -->
  <div id="editProfile" class="modal">
    <div class="modal-content">
      <form action="" id="fEditProfile" accept-charset="utf-8">
      	{{ csrf_field() }}
      	<div class="groupProfile">
      		
      	</div>
      </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Thoát</a>
    </div>
  </div>
@stop
@section('footer')
	@if(Session::has('message'))
		<script type="text/javascript"> Materialize.toast("{{ Session::get('message')}}", 4000);</script>
	@endif
@stop