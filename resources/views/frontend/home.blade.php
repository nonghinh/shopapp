@extends('layouts.master')
@section('title')
	Home
@stop
@section('content')

	<div id="map" style="width:100%; height:582px;"></div>
	<div id="tokenHome">
		{!! csrf_field() !!}
	</div>
	<div id="modalInfoMarker" class="modal bottom-sheet">
	    <div class="modal-content">
	      <div class="row">
	      	<div class="sideImg col m4">
	      		<img src="" alt="" class="materialboxed coverImg" width="100%" height="100%">
	      	</div>
	      	<div class="sideContent col m8">
	      		<div id="basicInfo" class="col m6">
	      			<div class="pointHeading">
				      <h4 class="pointName">Thông tin</h4>
				    </div>
				    <div class="pointBody">
				    	<div class="info-group">
				      		<label>Địa điểm:</label>
				      		<span class="location">sdasdas</span>
				      	</div>
				      	<div class="info-group">
				      		<label>Địa chỉ:</label>
				      		<span class="address">sdasdas</span>
				      	</div>
						<div class="info-group">
					      	<label>Email:</label>
					      	<span class="email">sdasdas</span>
					    </div>
					    <div class="info-group">
					      	<label>Điện thoại:</label>
					      	<span class="phone">sdasdas</span>
					    </div>
					    <div class="info-group">
					      	<label>Website:</label>
					      	<span class="website">sdasdas</span>
					    </div>
					    <div class="info-group">
					      	<label>Mô tả:</label>
					      	<span class="description">sdasdas</span>
					    </div>
					    <div class="info-group">
					      	<label>Sức chứa:</label>
					      	<span class="capacity">sdasdas</span>
					    </div>
					    <div class="info-group">
					      	<label>Mở cửa:</label>
					      	<span class="work_time">dđs</span>
					    </div>
					    <div class="info-group">
					      	<label>Giá cả:</label>
					      	<span class="price">sdasdas</span>
					    </div>

				    </div>
	      		</div>
	      		<div id="eventInfo" class="col m6">
	      			<div class="pointHeading">
				      <h4 class="pointName">Sự kiện đang diễn ra</h4>
				    </div>
				    	<strong class="alert blue-text"></strong>
				    <div class="pointBody">
				    	<div class="info-group">
				    		<label>Sự kiện:</label>
					    	<span class="eventname"></span>
				    	</div>
				    	<div class="info-group">
				    		<label>Loại sự kiện:</label>
					    	<span class="eventtype"></span>
				    	</div>
				    	<div class="info-group">
				    		<label>Danh mục:</label>
					    	<span class="eventcate"></span>
				    	</div>
				    	<div class="info-group">
				    		<label>Chi tiết:</label>
					    	<p class="eventinfo"></p>

				    	</div>
				    	<div class="info-group">
				    		<label>Thời gian diễn ra:</label>
					    	<p class="eventtime"><strong>Từ: </strong><span class="starttime">...</span> <strong>đến: </strong> <span class="endtime">...</span></p>					    		    	
				    	</div>
				    </div>
	      		</div>
	      	</div>
	      </div>
	    </div>
	    <div class="divider"></div>
	    <div class="modal-footer">
	      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
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
		var active = <?php echo $active; ?>
	
		var _dir = "{{ url('/') }}";
	</script>
@stop