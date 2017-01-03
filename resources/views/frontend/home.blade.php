@extends('layouts.master')
@section('title')
	Home
@stop
@section('content')

	<div id="map" style="width:100%; height:582px;"></div>
	<div id="tokenHome">
		{!! csrf_field() !!}
	</div>
	<div id="modalInfoMarker" class="modal white">
	    <div class="modal-content">
	    
	      <div class="modal-image">
	      	<img class="m-image coverImg" src="" alt="">
	      	<h1 class="m-title"></h1>
	      </div>
	      <div class="m-content">
	      	<div id="basicInfo"></div>
	      	<div id="eventInfo"></div>
	      	<div id="loc-info">
	      		<p>Để biết thêm thông tin chi tiết vui lòng liên hệ: <span class="contact"></span></p>
	      	</div>
	      </div>
	      <!-- Comment facebook -->
	      <div class="fb">
	      	<div class="fb-title">
	      		<h3 class="title">Bình luận</h3>
	      	</div>
	      	<div id="fbComment"></div>
	      </div>
	     </div>
	    <!-- End modal content -->
	    <div class="divider"></div>
	    <div class="modal-footer white">
	      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">OK</a>
	    </div>
	    <input type="hidden" id="data-event" name="data-event" value="">
	</div>
@stop
@section('footer')
	<script type="text/javascript">
		var jsonLocations = <?php echo $jsonLocations; ?>;
		var jsonEvents = <?php echo isset($jsonEvent) ? $jsonEvent : ''; ?>;
		var jsonEventType = <?php echo $jsonEventType; ?>;
		var jsonCates = <?php echo $jsonCates; ?>;
		var active = <?php echo $active; ?>;	
		var _dir = "{{ url('/') }}";
	</script>
@stop