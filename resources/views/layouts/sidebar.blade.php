  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

            <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Header</li>
        <!-- Optionally, you can add icons to the links -->
        
        <li @if (Route::currentRouteNamed('aircraft.index') 
              or Route::currentRouteNamed('aircraft.create')
              or Route::currentRouteNamed('aircraft.show')
              or Route::currentRouteNamed('aircraft.edit')
              ) class="active" @endif >
          <a href="{{ route('aircraft.index') }}"><i class="fa fa-h-square"></i> <span>Aircrafts</span></a>
        </li>

        <li @if (Route::currentRouteNamed('engine.index') 
              or Route::currentRouteNamed('engine.create')
              or Route::currentRouteNamed('engine.show')
              or Route::currentRouteNamed('engine.edit')
              ) class="active" @endif >
          <a href="{{ route('engine.index') }}"><i class="fa fa-video-camera"></i> <span>Engines</span></a>
        </li>
        <li @if (Route::currentRouteNamed('aircraftType.index') 
          or Route::currentRouteNamed('aircraftType.create')
          or Route::currentRouteNamed('aircraftType.show')
          or Route::currentRouteNamed('aircraftType.edit')
          or Route::currentRouteNamed('engineType.index') 
          or Route::currentRouteNamed('engineType.create')
          or Route::currentRouteNamed('engineType.show')
          or Route::currentRouteNamed('engineType.edit')
        ) class="treeview active menu-open" @else class="treeview" @endif
        >
          <a href="#">
            <i class="fa fa-cog"></i> <span>Configuration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @if (Route::currentRouteNamed('aircraftType.index') 
                  or Route::currentRouteNamed('aircraftType.create')
                  or Route::currentRouteNamed('aircraftType.show')
                  or Route::currentRouteNamed('aircraftType.edit')
                  ) class="active" @endif >
              <a href="{{ route('aircraftType.index') }}"><i class="fa fa-h-square"></i> <span>Aircraft</span></a>
            </li>

            <li @if (Route::currentRouteNamed('engineType.index') 
                  or Route::currentRouteNamed('engineType.create')
                  or Route::currentRouteNamed('engineType.show')
                  or Route::currentRouteNamed('engineType.edit')
                  ) class="active" @endif >
              <a href="{{ route('engineType.index') }}"><i class="fa fa-video-camera"></i> <span>Engine</span></a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->

    </section>
    <!-- /.sidebar -->
  </aside>
