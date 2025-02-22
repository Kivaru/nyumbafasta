
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
        <img
          src="{{  Auth::user()->image != null ? asset('storage/profile_photo/'. Auth::user()->image) : asset('backend/img/user2-160x160.jpg') }}"
          style="height: 100px; width: 100px" class="img-circle elevation-2" alt="User Image">
        <br>
        <div style="color: #000000;line-height: 4px; font-weight: 600" class="text-center mt-3 info">
          <p>Name: {{ Auth::user()->name }}</p>
          <p>Phone Number: {{ Auth::user()->contact }}</p>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      {{-- admin sidebar --}}
        @if (Request::is('admin*'))
        <li class="nav-item has-treeview active">
          <a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <i class="fa fa-dashboard"></i>
            <p class="ml-2">
              Dashboard
            </p>
          </a>
        </li>


        <li class="nav-item has-treeview">
          <a href="{{ route('admin.area.index') }}" class="nav-link {{ Request::is('admin/area*') ? 'active' : '' }}">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <p class="pl-2">Areas</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="https://customerservice.newambassador.sc.tz/" target="_blank" class="nav-link">
              <i class="fa fa-users" aria-hidden="true"></i>
              <p class="pl-2">Customer Care</p>
            </a>
          </li>

        <li class="nav-item has-treeview">
            <a href="{{ route('admin.transactions.pending_even') }}" class="nav-link {{ Request::is('admin/manage-properties-for-sale*') ? 'active' : '' }}">
              <i class="fa fa-money" aria-hidden="true"></i>
              <p class="pl-2">
              Pending Transactions(Neema)
              </p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="{{ route('admin.transactions.pending_odd') }}" class="nav-link {{ Request::is('admin/manage-properties-for-sale*') ? 'active' : '' }}">
              <i class="fa fa-money" aria-hidden="true"></i>
              <p class="pl-2">
                Pending Transactions(Monica)
              </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="{{ route('admin.transactions.completed') }}" class="nav-link {{ Request::is('admin/manage-properties-for-sale*') ? 'active' : '' }}">
              <i class="fa fa-money" aria-hidden="true"></i>
              <p class="pl-2">
                Completed Transactions
              </p>
            </a>
        </li>


        <li class="nav-item has-treeview">
          <a href="{{ route('admin.house.index') }}" class="nav-link {{ Request::is('admin/house*') ? 'active' : '' }}">
            <i class="fa fa-home" aria-hidden="true"></i>
            <p class="pl-2">
              Houses
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="{{ route('admin.property.index') }}" class="nav-link {{ Request::is('admin/manage-properties-for-sale*') ? 'active' : '' }}">
              <i class="fa fa-home" aria-hidden="true"></i>
              <p class="pl-2">
                Manage Properties For Sale
              </p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="{{ route('admin.manage.agent') }}"
              class="nav-link {{ Request::is('admin/manage-agent') ? 'active' : '' }}">
              <i class="fa fa-users"></i>
              <p class="pl-2">
                Manage Agents
              </p>
            </a>
          </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.manage.landlord') }}"
            class="nav-link {{ Request::is('admin/manage-landlord') ? 'active' : '' }}">
            <i class="fa fa-users"></i>
            <p class="pl-2">
              Manage Landlords
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.manage.unverified.landlord') }}"
            class="nav-link {{ Request::is('admin/manage-unverified-landlord') ? 'active' : '' }}">
            <i class="fa fa-users"></i>
            <p class="pl-2">
              Unverified Landlords
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.manage.verified.landlord') }}"
            class="nav-link {{ Request::is('admin/manage-verified-landlord') ? 'active' : '' }}">
            <i class="fa fa-users"></i>
            <p class="pl-2">
              Verified Landlords
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.manage.renter') }}"
            class="nav-link {{ Request::is('admin/manage-renter') ? 'active' : '' }}">
            <i class="fa fa-users"></i>
            <p class="pl-2">
              Manage Renters
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.manage.dalali') }}"
            class="nav-link {{ Request::is('admin/manage-dalali') ? 'active' : '' }}">
            <i class="fa fa-users"></i>
            <p class="pl-2">
              Manage Dalali
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('admin.profile.show') }}"
            class="nav-link {{ Request::is('admin/profile-info') ? 'active' : '' }}">
            <i class="fa fa-user"></i>
            <p class="pl-2">
              Profile Info
            </p>
          </a>
        </li>
        @endif

        {{-- landlord sidebar --}}
        @if (Request::is('landlord*'))
        <li class="nav-item has-treeview">
          <a href="{{ route('landlord.dashboard') }}"
            class="nav-link {{ Request::is('landlord/dashboard') ? 'active' : '' }}">
            <i class="fa fa-dashboard"></i>
            <p class="pl-2">
              Dashboard
            </p>
          </a>
        </li>


        <!-- <li class="nav-item has-treeview">
          <a href="{{ route('landlord.area.index') }}"
            class="nav-link {{ Request::is('landlord/area*') ? 'active' : '' }}">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <p class="pl-2">Area</p>
          </a>
        </li> -->

        <li class="nav-item has-treeview">
          <a href="{{ route('landlord.house.index') }}"
            class="nav-link {{ Request::is('landlord/house*') ? 'active' : '' }}">
            <i class="fa fa-home" aria-hidden="true"></i>
            <p class="pl-2">
              House
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('landlord.profile.show') }}"
            class="nav-link {{ Request::is('landlord/profile-info*') ? 'active' : '' }}">
            <i class="fa fa-user"></i>
            <p class="pl-2">
              Profile Info
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('landlord.bookingRequestList') }}"
            class="nav-link {{ Request::is('landlord/booking-request-list') ? 'active' : '' }}">
            <i class="fa fa-circle-o-notch"></i>
            <p class="pl-2">
              Pending Request
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('landlord.currently.staying') }}"
            class="nav-link {{ Request::is('landlord/booked/currently/renter') ? 'active' : '' }}">
            <i class="fa fa-check"></i>
            <p class="pl-2">
              Booked Houses
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('landlord.history') }}"
            class="nav-link {{ Request::is('landlord/booking/history') ? 'active' : '' }}">
            <i class="fa fa-history"></i>
            <p class="pl-2">
              Booking History
            </p>
          </a>
        </li>
        @endif

        @if (Request::is('dalali*'))
        <li class="nav-item has-treeview">
          <a href="{{ route('dalali.dashboard') }}"
            class="nav-link {{ Request::is('dalali/dashboard') ? 'active' : '' }}">
            <i class="fa fa-dashboard"></i>
            <p class="pl-2">
              Dashboard
            </p>
          </a>
        </li>


        <!-- <li class="nav-item has-treeview">
          <a href="{{ route('landlord.area.index') }}"
            class="nav-link {{ Request::is('landlord/area*') ? 'active' : '' }}">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <p class="pl-2">Area</p>
          </a>
        </li> -->

        <li class="nav-item has-treeview">
          <a href="{{ route('dalali.house.index') }}"
            class="nav-link {{ Request::is('dalali/house*') ? 'active' : '' }}">
            <i class="fa fa-home" aria-hidden="true"></i>
            <p class="pl-2">
              House
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('dalali.profile.show') }}"
            class="nav-link {{ Request::is('dalali/profile-info*') ? 'active' : '' }}">
            <i class="fa fa-user"></i>
            <p class="pl-2">
              Profile Info
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('dalali.bookingRequestList') }}"
            class="nav-link {{ Request::is('dalali/booking-request-list') ? 'active' : '' }}">
            <i class="fa fa-circle-o-notch"></i>
            <p class="pl-2">
              Pending Request
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('dalali.currently.staying') }}"
            class="nav-link {{ Request::is('dalali/booked/currently/renter') ? 'active' : '' }}">
            <i class="fa fa-check"></i>
            <p class="pl-2">
              Booked Houses
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('dalali.history') }}"
            class="nav-link {{ Request::is('dalali/booking/history') ? 'active' : '' }}">
            <i class="fa fa-history"></i>
            <p class="pl-2">
              Booking History
            </p>
          </a>
        </li>
        @endif

         {{-- renter sidebar --}}
        @if (Auth::user()->role_id == 3)
        <li class="nav-item has-treeview">
          <a href="{{ route('renter.dashboard') }}"
            class="nav-link {{ Request::is('renter/dashboard') ? 'active' : '' }}">
            <i class="fa fa-dashboard"></i>
            <p class="pl-2">
              Dashboard

            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('renter.areas') }}" class="nav-link {{ Request::is('renter/areas') ? 'active' : '' }}">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <p class="pl-2">Areas</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('renter.profile.show') }}"
            class="nav-link {{ Request::is('renter/profile-info*') ? 'active' : '' }}">
            <i class="fa fa-user"></i>
            <p class="pl-2">
              Profile Info
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('renter.allHouses') }}" class="nav-link {{ Request::is('renter/house*') ? 'active' : '' }}">
            <i class="fa fa-home" aria-hidden="true"></i>
            <p class="pl-2">
              House
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{ route('renter.cart') }}"
            class="nav-link {{ Request::is('renter/cart') ? 'active' : '' }}">
            <i class="fa fa-history"></i>
            <p class="pl-2">
              My Bookings
            </p>
          </a>
        </li>

        {{-- <li class="nav-item has-treeview">
          <a href="{{ route('renter.booking.pending') }}"
            class="nav-link {{ Request::is('renter/pending/booking') ? 'active' : '' }}">
            <i class="fa fa-bell"></i>
            <p class="pl-2">
              My Pending Booking
            </p>
          </a>
        </li> --}}

        <li class="nav-item has-treeview">
          <a href="{{ route('welcome') }}" class="nav-link">
            <i class="fa fa-dashboard"></i>
            <p class="pl-2">
              Go To Home Page
            </p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
