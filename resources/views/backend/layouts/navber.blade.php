    <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="{{ url('/') }}" class="nav-link">
                <img src="{{asset('/images/4132.jpg')}}" style="width: 100%; height:60px" alt="profile">
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('category.index')}}">
                <span class="menu-title">Category</span>
                <i class="mdi mdi-package menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('products.index')}}">
                <span class="menu-title">Products</span>
                <i class="mdi mdi-tshirt-crew menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('orderss.index')}}">
                <span class="menu-title">Orders</span>
                <i class="mdi mdi-library-books menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('orders_re.index')}}">
                <span class="menu-title">Return products</span>
                <i class="mdi mdi-backup-restore menu-icon"></i>
              </a>
            </li>
            

          </ul>
</nav>
