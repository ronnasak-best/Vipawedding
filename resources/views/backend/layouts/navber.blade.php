    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="{{ url('/') }}" class="nav-link">
                    <img src="{{ asset('/images/4132.jpg') }}" style="width: 100%; height:60px" alt="profile">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bank.index') }}">
                    <span class="menu-title">บัญชี</span>
                    <i class="mdi mdi-backup-restore menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('category.index') }}">
                    <span class="menu-title">Category</span>
                    <i class="mdi mdi-package menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <span class="menu-title">Products</span>
                    <i class="mdi mdi-tshirt-crew menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orderss.index') }}">
                    <span class="menu-title">Orders</span>
                    <i class="mdi mdi-library-books menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders_re.index') }}">
                    <span class="menu-title">Return products</span>
                    <i class="mdi mdi-backup-restore menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" href="#general-pages" aria-expanded="false"
                    aria-controls="general-pages">
                    <span class="menu-title">รายงาน</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-medical-bag menu-icon"></i>
                </a>
                <div class="collapse" id="general-pages" style="">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('reports.index') }}"> รายงานสรุปการชำระเงินค่ามัดจำ/ค่าปรับ </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('reports.create') }}">รายงานการเช่า </a></li>
                    </ul
                </div>
            </li>




        </ul>
    </nav>
