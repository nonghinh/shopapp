@if($data->count() > 0)
	<ul class="collection">
	@foreach($data as $item)
	    <li class="collection-item avatar">
	      <a href="{{ url('?slug='.$item->slug.'&id='.$item->id)}}">
	      	<img src="{{ url('/upload/covers/'.$item->cover_image)}}" alt="{{ $item->name }}" class="circle">
	      <h3 class="title teal-text">{{ $item->name }}</h3>
	      <p class="grey-text">{{ $item->address }}</p>
	      <?php 
			$now = Carbon\Carbon::now();
			$eventR = DB::table('event_restaurant')->where('restaurant_id', $item->id)->where('start_time', '<=', $now)->where('end_time', '>', $now)->first();
			$eventF = DB::table('event_restaurant')->where('restaurant_id', $item->id)->where('start_time', '>', $now)->first();
			?>
		@if($eventR)
			<span class="secondary-content">Đang có sự kiện<i class="material-icons red-text">brightness_high</i></span>
		@elseif($eventF)
			<span class="secondary-content">Sắp có sự kiện<i class="material-icons blue-text">brightness_high</i></span>
		@else
			<span class="secondary-content"><i class="material-icons">my_location</i></span>
		@endif
	      </a>
	    </li>
    
	@endforeach
	</ul>
@else
	<strong class="center">Không có kêt quả</strong>
@endif