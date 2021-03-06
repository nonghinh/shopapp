<ul id="slide-out" class="side-nav fixed">
  <li>
    <div class="userView blue-grey darken-3 hide-on-med-and-down">
    <a href="{!! url('/')!!}">
      <img src="{!! url('upload/images/logo.png')!!}" alt="storestreaming">
    </a>
    </div>
  </li>
  <?php $siteCates = DB::table('categories')->orderBy('name', 'ASC')->get(); ?>
  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header waves-effect">Danh mục<i class="material-icons right">arrow_drop_down</i></a>
        <div class="collapsible-body">
          <ul class="blue-grey darken-1">
            @foreach($siteCates as $cate)
              <li><a href="{{url('chuyen-muc/'.$cate->slug.'/'.$cate->id)}}"><i class="material-icons left">gps_not_fixed</i>{{ $cate->name }}</a></li>
            @endforeach
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <?php $siteEvents = DB::table('event_types')->orderBy('name', 'ASC')->get(); ?>
  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header waves-effect">Sự kiện<i class="material-icons right">arrow_drop_down</i></a>
        <div class="collapsible-body">
          <ul class="blue-grey darken-1">
            @foreach($siteEvents as $event)
              <li><a href="{{url('su-kien/'.$event->slug.'/'.$event->id)}}"><i class="material-icons left">adjust</i>{{ $event->name }}</a></li>
            @endforeach
          </ul>
        </div>
      </li>
    </ul>
  </li>
  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header waves-effect">Khoảng cách<i class="material-icons right">arrow_drop_down</i></a>
        <div class="collapsible-body">
          <ul class="blue-grey darken-1">
              <li><a href="{{url('loc-khoang-cach/2')}}"><i class="material-icons left">update</i>2 km gần nhất</a></li>
              <li><a href="{{url('loc-khoang-cach/3')}}"><i class="material-icons left">update</i>3 km gần nhất</a></li>
              <li><a href="{{url('loc-khoang-cach/5')}}"><i class="material-icons left">update</i>5 km gần nhất</a></li>
              <li><a href="{{url('loc-khoang-cach/10')}}"><i class="material-icons left">update</i>10 km gần nhất</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>
</ul>