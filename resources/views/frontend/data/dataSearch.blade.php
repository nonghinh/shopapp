@if($data->count() > 0)
	<ul class="collection">
	@foreach($data as $item)
	    <li class="collection-item avatar">
	      <a href="{{ url('?slug='.$item->slug.'&id='.$item->id)}}">
	      	<img src="{{ url('/upload/covers/'.$item->cover_image)}}" alt="{{ $item->name }}" class="circle">
	      <h3 class="title teal-text">{{ $item->name }}</h3>
	      <p class="grey-text">{{ $item->address }}</p>
	      <a href="{{ url('?slug='.$item->slug.'&id='.$item->id)}}" class="secondary-content"><i class="material-icons">my_location</i></a>
	      </a>
	    </li>
    
	@endforeach
	</ul>
@else
	<strong class="center">Không có kêt quả</strong>
@endif