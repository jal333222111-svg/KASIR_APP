 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link text-center">
        <img src="{{ asset('logo2.png') }}" alt="Logo" class="brand-image img-circle elevation-4" style="opacity: .8">
        <span class="brand-text font-weight-light">VAN SHOP</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @foreach ($routes as $route)
              @if ($route['is_dropdown'])
                  {{-- MENU DROPDOWN --}}
                <li class="nav-item {{ request()->routeIs($route['route_active'] . '.*') ? 'menu-open' : '' }}">
                      <a href="#" class="nav-link {{ request()->routeIs($route['route_active'] . '.*') ? 'active' : '' }}">
                          <i class="nav-icon {{ $route['icon'] }}"></i>
                          <p>
                              {{ $route['label'] }}
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @foreach ($route['dropdown'] as $child)
                              <li class="nav-item">
                                  <a href="{{ route($child['route_name']) }}" 
                                    class="nav-link {{ request()->routeIs($child['route_active']) ? 'active' : '' }}">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>{{ $child['label'] }}</p>
                                  </a>
                              </li>
                          @endforeach
                      </ul>
                  </li>
              @else
                  {{-- MENU BIASA --}}
                  <li class="nav-item">
                      <a href="{{ route($route['route_name']) }}" 
                        class="nav-link {{ request()->routeIs($route['route_active']) ? 'active' : '' }}">
                          <i class="nav-icon {{ $route['icon'] }}"></i>
                          <p>{{ $route['label'] }}</p>
                      </a>
                  </li>
              @endif
          @endforeach
          </ul>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>