<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('theme/admin/assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('theme/admin/assets/images/logo-dark.png')}}" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('theme/admin/assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('theme/admin/assets/images/logo-light.png')}}" alt="" height="17">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Quản Lý Sản Phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link" data-key="t-analytics"> Danh Sách Sản Phẩm </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.create') }}" class="nav-link" data-key="t-analytics"> Thêm Sản Phẩm </a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
