@extends('layouts.master')
@section('title', 'Danh sách sự kiện')
@section('content')
	<div class="heading">
		<h1>Thông tin sự kiện</h1>
	</div>
	<div class="row">
		<div class="col s12">
			<h4>Sự kiện bạn đã thêm</h4>
			@if($eventY)
				<ul class="collapsible" data-collapsible="accordion">
				    @foreach($eventY as $event)
				    <li>
				      <div class="collapsible-header"><i class="material-icons">keyboard_arrow_down</i>{{ $event->name}} <span><strong>Từ: </strong>{{ formatTime($event->start_time) }} <strong> đến: </strong> {{ formatTime($event->end_time) }}</span>
						<a href="{{ url('xoa-su-kien/'.$event->slug.'/'.$event->id)}}" class="right red-text" onclick="return confirmDelete()"><i class="material-icons">remove_circle</i></a>
						<a href="{{ url('update-su-kien/'.$event->slug.'/'.$event->id)}}" class="right"><i class="material-icons">edit</i></a>
				      </div>
				      <div class="collapsible-body"><p>{{ $event->info_event}}</p></div>
				    </li>
				    @endforeach
				</ul>
			@else
				<strong>Không sự kiện nào</strong>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<h4>Sự kiện khác đang diễn ra</h4>
			@if($eventR)
				<ul class="collapsible" data-collapsible="accordion">
				    @foreach($eventR as $event)
				    <li>
				      <div class="collapsible-header"><i class="material-icons">keyboard_arrow_down</i>{{ $event->name}} <span><strong>Từ: </strong>{{ formatTime($event->start_time) }} <strong> đến: </strong> {{ formatTime($event->end_time) }}</span>
						<a href="" class="right red-text"><i class="material-icons">remove_circle</i></a>
						<a href="" class="right"><i class="material-icons">edit</i></a>
				      </div>
				      <div class="collapsible-body"><p>{{ $event->info_event}}</p></div>
				    </li>
				    @endforeach
				</ul>
			@else
				<strong>Không sự kiện nào</strong>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<h4>Sự kiện sắp tơi</h4>
			@if($eventF)
				<ul class="collapsible" data-collapsible="accordion">
				    @foreach($eventF as $event)
				    <li>
				      <div class="collapsible-header"><i class="material-icons">keyboard_arrow_down</i>{{ $event->name}} <span><strong>Từ: </strong>{{ formatTime($event->start_time) }} <strong> đến: </strong> {{ formatTime($event->end_time) }}</span>
						<a href="" class="right red-text" onclick="return confirmDelete()"><i class="material-icons">remove_circle</i></a>
						<a href="" class="right"><i class="material-icons">edit</i></a>
				      </div>
				      <div class="collapsible-body"><p>{{ $event->info_event}}</p></div>
				    </li>
				    @endforeach
				</ul>
			@else
				<strong>Không sự kiện nào</strong>
			@endif
		</div>
	</div>
	
@stop
@section('footer')
	@if(Session::has('message'))
		<script type="text/javascript">
			Materialize.toast("{{ Session::get('message')}}", 4000);
		</script>
	@endif
@stop