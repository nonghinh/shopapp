@extends('backend.app')
@section('title', 'Dashboard')

@section('page-header', 'Dashboard')

@section('content')
	<div class="wrappper">
		<!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $users->count() }}</div>
                                <div>Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('goto/backend/user/show')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-map-marker fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $rests->count() }}</div>
                                <div>Restaurants</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('goto/backend/restaurant/show')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-gift fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $eRests->count() }}</div>
                                <div>Events</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('goto/backend/eventrestaurant') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $cates->count() }}</div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('goto/backend/cate/show')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
	</div>
@stop