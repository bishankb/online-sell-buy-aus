<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="./index.html" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="./assets/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">MAIN NAVIGATION</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
        id="navigation"
      >
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>
              Dashboard
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
        </li>

        @can('view_categories')
            <li class="nav-item {{Request::is('admin/categories*') ? 'active' : ''}}">
                <a href="{{route('categories.index')}}" class="nav-link">
                  <i class="fa fa-list" style="margin: 5px;"></i><span>Category</span>
                </a>
            </li>
        @endcan
        @can('view_sub_categories')
            <li class="nav-item {{Request::is('admin/sub-categories*') ? 'active' : ''}}">
                <a href="{{route('sub-categories.index')}}" class="nav-link">
                  <i class="fa fa-list-alt" style="margin: 5px;"></i><span>SubCategory</span>
                </a>
            </li>
        @endcan
        
        @can('view_users')
          <li class="nav-item {Request::is('admin/users*') ? 'active' : ''}}">
            <a href="{{route('users.index')}}" class="nav-link">
              <i class="fa fa-user" style="margin: 5px;"></i>
              <p>Users</p>
            </a>
          </li>
        @endcan
        @can('view_cities')
          <li class="nav-item {{Request::is('admin/cities*') ? 'active' : ''}}">
              <a href="{{route('cities.index')}}" class="nav-link">
                <i class="fa fa-map-marker" style="margin: 5px;"></i><span>City</span>
              </a>
          </li>
        @endcan
        @can('view_countries')
          <li class="nav-item {{Request::is('admin/countries*') ? 'active' : ''}}">
            <a href="{{route('countries.index')}}" class="nav-link">
              <i class="fa fa-globe" style="margin: 5px;"></i><span>Country</span>
            </a>
          </li>
        @endcan
        @can('view_roles')
            <li class="nav-item {{ Request::is('admin/roles*') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}" class="nav-link">
                    <i class="fa fa-adn" style="margin: 5px;"></i><span>Roles</span>
                </a>
            </li>
        @endcan
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>