<!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <!-- <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                    </ul>
                  </li> -->
                  <li><a href="{!! url('goto/backend/dashboard') !!}"><i class="fa fa-home"></i>Dashboard</a></li>
                  <li><a><i class="fa fa-users"></i>Users<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{!! url('goto/backend/user/show')!!}">Show all users</i></a></li>
                      <li><a href="{!! url('goto/backend/user/add')!!}">Add new user</i></a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-map-marker"></i>Restaurants<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{!! url('goto/backend/restaurant') !!}">Show all restaurants</i></a></li>
                      <li><a href="{!! url('them-dia-diem') !!}">Add new restaurant</i></a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-calendar"></i>Event types<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{!! url('goto/backend/event/show')!!}">Show all event types</i></a></li>
                      <li><a href="{!! url('goto/backend/event/add')!!}">Add new event type</i></a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-gift"></i>Events<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{!! url('goto/backend/eventrestaurant')!!}">Show all events</i></a></li>
                      <li><a href="{!! url('them-su-kien')!!}">Add new event</i></a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-th"></i>Categories<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{!! url('goto/backend/cate/show')!!}">Show all categories</i></a></li>
                      <li><a href="{!! url('goto/backend/cate/add')!!}">Add new category</i></a></li>
                    </ul>
                  </li>
                  
                </ul>
              </div>
            </div>
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->