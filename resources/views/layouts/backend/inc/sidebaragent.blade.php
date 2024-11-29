
<aside class="main-sidebar sidebar-dark-light elevation-4" style="background-color: #eb8000;overflow-y:auto;">
    <!-- Brand Logo -->
    {{-- <a href="" class="brand-link text-center">
        <span class="brand-text font-weight-bold">{{ Auth::user()->role_id == 1 ? 'Admin Panel' : 'User Panel' }}</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image text-center">

          <br>
          <div style="color: #000000;line-height: 4px; font-weight: 600" class="text-center mt-3 info">
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        {{-- admin sidebar --}}

          <li class="nav-item has-treeview active">
            <a href="{{ route('welcome') }}"
              class="nav-link {{ Request::is('/') ? 'active' : '' }}">
              <i class="fa fa-dashboard"></i>
              <p class="ml-2">
                Back Home
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
