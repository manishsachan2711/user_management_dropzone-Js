
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('home')}}" class="brand-link">
    <img src="{{ asset('admin/theme/dist/img/leaf.png') }}" alt="User Management" class="brand-image img-circle elevation-3" style="opacity: .8">

    <span class="brand-text font-weight-light">User Management</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @if(isset(Auth::user()->profile_photo))
        <img src={{ url("uploads/images/".Auth::user()->profile_photo) }} class="img-circle elevation-2" alt="">
        @else
        <img src="{{ url("admin/image/user.png") }}" class="img-circle elevation-2" alt="">
        @endif
      </div>
      <div class="info">
        @if(Auth::check())
        <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
        @else
        <a href="#" class="d-block"> {{ '' }}</a>
        @endif
      </div>
    </div>

    <!-- SidebarSearch Form -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        @if(Auth::check())
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" style="background-color: #117a8b;" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>

        </li>

        <li class="nav-item menu-open">
            <a href="{{ route('admin.user') }}" style="background-color: #111b8b;" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
              <p>
                Users
              </p>
            </a>

          </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Profile
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('admin.profile') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Update Profile</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <p>
              {{ __('Logout') }}
            </p>
          </a>

          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>

        </li>
      </ul>
      @endif
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
