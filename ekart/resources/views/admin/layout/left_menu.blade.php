<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
               Dashboard
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.userinfo') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Userinfo
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
          <li class="nav-item">
            <a href="{{ route('admin.product.list') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Product
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orderinfo') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    payment
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>
      <li class="nav-item">
        <a href="{{ route('admin.logout') }}" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
           logout
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li>

    </ul>
  </nav>
