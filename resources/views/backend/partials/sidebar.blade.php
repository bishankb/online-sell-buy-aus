<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ route('frontend.home') }}" target="_blank" class="brand-link">
      <!--begin::Brand Text-->
      <span class="brand-text fw-light"><i class="fa fa-cogs" style="margin: 5px;"></i>{{ env('APP_NAME')}}</span>
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
        @can('view_dashboards')
          <li class="nav-item">
              <a href="{{route('backend.dashboard')}}" class="nav-link {{Request::is('admin/dashboard*') ? 'active' : ''}}">
                <i class="fa fa-dashboard " style="margin: 5px;"></i><span>Dashboard</span>
              </a>
          </li>
        @endcan

        @can('view_categories')
          <li class="nav-item">
              <a href="{{route('categories.index')}}" class="nav-link {{Request::is('admin/categories*') ? 'active' : ''}}">
                <i class="fa fa-list" style="margin: 5px;"></i><span>Category</span>
              </a>
          </li>
        @endcan

        @can('view_sub_categories')
          <li class="nav-item">
              <a href="{{route('sub-categories.index')}}" class="nav-link {{Request::is('admin/sub-categories*') ? 'active' : ''}}">
                <i class="fa fa-list-alt" style="margin: 5px;"></i><span>SubCategory</span>
              </a>
          </li>
        @endcan

        @can('view_products')
            <li class="nav-item">
                <a href="{{route('products.index')}}" class="nav-link {{Request::is('admin/products*') ? 'active' : ''}}">
                  <i class="fa fa-shopping-cart" style="margin: 5px;"></i><span>Product</span>
                </a>
            </li>
        @endcan

        @can('view_buyer_questions')
            <li class="nav-item">
                <a href="{{route('buyer-questions.index')}}" class="nav-link {{Request::is('admin/buyer-questions*') ? 'active' : ''}}">
                  <i class="fa fa-question-circle" style="margin: 5px;"></i><span>Buyer Questions</span>
                </a>
            </li>
        @endcan
        
        @can('view_users')
          <li class="nav-item {Request::is('admin/users*') ? 'active' : ''}}">
            <a href="{{route('users.index')}}" class="nav-link {{Request::is('admin/users*') ? 'active' : ''}}">
              <i class="fa fa-user" style="margin: 5px;"></i><span>Users</span>
            </a>
          </li>
        @endcan

        @can('view_dashboards')
          <li class="nav-item">
              <a href="{{route('contact-us.edit')}}" class="nav-link {{Request::is('admin/contact-us*') ? 'active' : ''}}">
                <i class="fa fa-phone" style="margin: 5px;"></i><span>Contact Us</span>
              </a>
          </li>
        @endcan
        
        <li class="nav-header" style="margin-left: 12px;">Misc</li>
        @can('view_faqs')
            <li class="nav-item">
                <a href="{{ route('faqs.index') }}" class="nav-link {{ Request::is('admin/faqs*') ? 'active' : '' }}">
                    <i class="fa fa-question-circle" style="margin: 5px;"></i><span>FAQ</span>
                </a>
            </li>
        @endcan
        @can('view_cities')
          <li class="nav-item">
              <a href="{{route('cities.index')}}" class="nav-link {{Request::is('admin/cities*') ? 'active' : ''}}">
                <i class="fa fa-map-marker" style="margin: 5px;"></i><span>City</span>
              </a>
          </li>
        @endcan

        @can('view_countries')
          <li class="nav-item">
            <a href="{{route('countries.index')}}" class="nav-link {{Request::is('admin/countries*') ? 'active' : ''}}">
              <i class="fa fa-globe" style="margin: 5px;"></i><span>Country</span>
            </a>
          </li>
        @endcan
        
        @can('view_roles')
            <li class="nav-item ">
                <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('admin/roles*') ? 'active' : '' }}">
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