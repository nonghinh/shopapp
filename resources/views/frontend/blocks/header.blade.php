<div class="navbar-fixed">
  <nav id="navbar-top" class="blue-grey lighten-1" >
    <div class="nav-wrapper">
      <a href="#" class="brand-logo hide-on-large-only">StoreStreaming</a>
      <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
      <a href="#" data-activates="slide-out-r" class="button-collapse-r right"><i class="material-icons">apps</i></a>

      <ul class="right hide-on-med-and-down">
        <li><a href="#aboutus" class="modal-trigger waves-effect waves-light">Giới thiệu</a></li>
        <li><a href="{!! url('/phan-hoi')!!}" title="">Phản hồi</a></li>
        @if(Auth::guest())
          <li><a href="{!! url('/dang-nhap') !!}" class="waves-effect waves-light btn blue-grey lighten-2">Đăng nhập</a></li>
          <li><a href="{!! url('/dang-ky') !!}" class="waves-effect waves-light btn blue-grey darken-1">Đăng ký</a></li>
        @else
          <li>
            <a href="javascript:void(0)" class="waves-effect waves-light dropdown-button" data-activates="dropUser">
              <i class="material-icons left">person</i> {{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i>
            </a>
            <!-- Dropdown Structure -->
            <ul id="dropUser" class="dropdown-content">
              <li><a href="{{ url('/userprofile')}}"><i class="material-icons left">face</i>Thông tin tài khoản</a></li>
              @if(Auth::user()->level == 2)
                <li><a href="{{ url('goto/backend/dashboard')}}"><i class="material-icons left">airplay</i>Quản lý hệ thống</a></li>
              @endif
              <li><a href="{!! url('/them-dia-diem') !!}"><i class="material-icons left">add_location</i>Thêm địa điểm</a></li>
              <li><a href="{!! url('/them-su-kien') !!}"><i class="material-icons left">card_giftcard</i>Thêm sự kiện</a></li>
              <li class="divider"></li>
              <li><a href="{!! url('logout') !!}"><i class="material-icons left">power_settings_new</i>Đăng xuất</a></li>
            </ul>
          </li>
        @endif
      </ul>
      <ul class="right">
        <li><a href="#modalSearch"><i class="material-icons left">search</i><span class="hide-on-med-and-down">Tìm kiếm</span></a></li>
      </ul>

      <ul class="side-nav blue-grey darken-3" id="slide-out-r">
        @if(Auth::guest())
          <li><a href="{!! url('/dang-nhap') !!}" class="text-white">Đăng nhập</a></li>
          <li><a href="{!! url('/dang-ky') !!}" class="text-white">Đăng ký</a></li>
        @else
        <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header"><i class="material-icons left">person</i> {!! Auth::user()->name !!} <i class="material-icons right">arrow_drop_down</i></a>
            <div class="collapsible-body">
              <ul id="dropUserMobile">
                <li><a href="{{ url('/userprofile')}}"><i class="material-icons left">face</i>Thông tin tài khoản</a></li>
                @if(Auth::user()->level == 2)
                  <li><a href="{{ url('goto/backend/dashboard')}}"><i class="material-icons left">airplay</i>Quản lý hệ thống</a></li>
                @endif
                <li><a href="{!! url('/them-dia-diem') !!}"><i class="material-icons left">add_location</i>Thêm địa điểm</a></li>
                 <li><a href="{!! url('/them-su-kien') !!}"><i class="material-icons left">card_giftcard</i>Thêm sự kiện</a></li>
                <li class="divider"></li>
                <li><a href="{!! url('logout') !!}"><i class="material-icons left">power_settings_new</i>Đăng xuất</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
        @endif
      </ul>
    </div>
  </nav>
</div>

<!-- Modal search -->
<!-- Modal Trigger -->
<!-- Modal Structure -->
<div id="modalSearch" class="modal">
  <div class="modal-content">
    <div id="formSearch">
    {!! csrf_field() !!}
      <input type="text" name="querySearch" id="inputSearch" value="" placeholder="Tìm kiếm...">
      <i class="material-icons">search</i>
    </div>
    <div id="resultSearch"></div>
  </div>
</div>
<!-- End Modal search -->
