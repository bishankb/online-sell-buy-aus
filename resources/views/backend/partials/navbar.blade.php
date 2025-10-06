<nav class="app-header navbar navbar-expand bg-body">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Start Navbar Links-->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>
    </ul>
    <!--end::Start Navbar Links-->
    <!--begin::End Navbar Links-->
    <ul class="navbar-nav ms-auto">
      <!--begin::Notifications Dropdown Menu-->
      <li class="nav-item dropdown">
        <a class="nav-link" data-bs-toggle="dropdown" href="#">
          <i class="bi bi-bell-fill"></i>
          @if(Auth::user()->unreadNotifications()->count())
            <span class="navbar-badge badge text-bg-warning">
                {{ Auth::user()->unreadNotifications()->count() }}
            </span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <span class="dropdown-item dropdown-header">
            {{ Auth::user()->unreadNotifications()->count() }} Notifications
            @if(Auth::user()->unreadNotifications->count() >0)
                <a style="float: right;" href="{{ route('notification.mark-read') }}"title="Mark All Notification as Read">
                    <span class="badge bg-danger">Clear All</span>
                </a>
            @endif
          </span>
          @foreach(Auth::user()->unreadNotifications->take(10) as $unreadNotification) 
            @if(isset($unreadNotification->data['message']))
              <div class="dropdown-divider"></div>
              @if(isset($unreadNotification->data['url']))
                <a href="{{ route('notification.read', $unreadNotification->id) }}" class="dropdown-item">
                  {{ $unreadNotification->data['message'] }}
                </a>
              @endif
            @endif
          @endforeach
          <div class="dropdown-divider"></div>

          <a href="{{ route('notification.view-notification') }}" class="dropdown-item dropdown-footer">
            <i class="fa fa-eye"></i> See All Notifications
          </a>
        </div>
      </li>
      <!--end::Notifications Dropdown Menu-->
      <!--begin::Fullscreen Toggle-->
      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
        </a>
      </li>
      <!--end::Fullscreen Toggle-->
      <!--begin::User Menu Dropdown-->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <span class="d-none d-md-inline">
            @if(isset( Auth::user()->profile->image->filename))
               <img
                  src="/storage/media/user/{{ Auth::user()->id }}/thumbnail/{{ Auth::user()->profile->image->filename }}"
                  class="user-image rounded-circle shadow d-md-inline"
                  alt="User Image"
                />
            @else
              <i class="fa fa-user"></i>
            @endif
           
            {{ Auth::user()->name }}
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <!--begin::User Image-->
          <li class="user-header text-bg-primary">
              @if(isset( Auth::user()->profile->image->filename))
                <img src="/storage/media/user/{{ Auth::user()->id }}/thumbnail/{{ Auth::user()->profile->image->filename }}" alt="User Image"class="rounded-circle shadow" alt="User Image" style="display:block; margin: 0 auto;">
              @else 
                <img src="{{ asset('frontend-template/img/no-image.jpg') }}" alt="User Image"class="rounded-circle shadow" alt="User Image" style="display:block; margin: 0 auto;">
              @endif
            <p>
              {{ Auth::user()->name }} - {{ Auth::user()->email }}
              <small>Member since {{ Auth::user()->created_at->format('M, Y') }}</small>
            </p>
          </li>
          <!--end::User Image-->
          <!--begin::Menu Footer-->
          <li class="user-footer">
            <a href="{{ route('users.edit', Auth::user()->id). '#profile' }}" class="btn btn-default btn-flat">Profile</a>
            <a href="#" class="btn btn-default btn-flat float-end" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
          <!--end::Menu Footer-->
        </ul>
      </li>
      <!--end::User Menu Dropdown-->
    </ul>
    <!--end::End Navbar Links-->
  </div>
  <!--end::Container-->
</nav>