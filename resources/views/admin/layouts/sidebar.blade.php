<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('theme/admin/assets/images/LOGO.png')}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('theme/admin/assets/images/LOGO.png')}}" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('theme/admin/assets/images/LogoManStyle.png')}}" alt="" height="22">
                    </span>
            <span class="logo-lg" >
                        <img href="/admin" src="{{asset('theme/admin/assets/images/LOGO.png')}}" alt="" width="150px" height="100">
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
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Danh mục</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.index')}}" class="nav-link" data-key="t-api-key">Danh sách danh mục</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Quản Lý Sản Phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('product.index') }}" class="nav-link" data-key="t-analytics"> Danh Sách Sản Phẩm </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product.create') }}" class="nav-link" data-key="t-analytics"> Thêm Sản Phẩm </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-share-line"></i> <span data-key="t-dashboards">Quản Lý Thuộc Tính Sản Phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('variant.index') }}" class="nav-link" data-key="t-analytics"> Danh Sách Thuộc Tính </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('variant.create') }}" class="nav-link" data-key="t-analytics"> Thêm Thuộc Tính </a>
                            </li>
                        </ul>
                    </div>
                </li><!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-share-line"></i> <span data-key="t-dashboards">Sản Phẩm Biến Thể</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDashboards">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('product_variant.index') }}" class="nav-link" data-key="t-analytics"> Danh Sách Sản Phẩm Biến Thể</a>
                            </li>
                        </ul>
                    </div>
                </li><!-- end Dashboard Menu -->
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarComments" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarComments">
                        <i class="ri-file-list-3-line"></i> <span data-key="t-dashboards">Quản Lý Bình Luận</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarComments">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('comment.index') }}" class="nav-link" data-key="t-analytics"> Danh Sách Sản Phẩm </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAccounts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="ri-account-circle-line"></i> <span data-key="t-dashboards">Quản Lý Tài Khoản</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAccounts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('accounts.index') }}" class="nav-link" data-key="t-analytics"> Danh Sách Tài Khoản </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('accounts.create') }}" class="nav-link" data-key="t-analytics"> Thêm Tài Khoản </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOrders" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarOrders">
                        <i class="ri-shopping-cart-line"></i> <span data-key="t-dashboards">Quản Lý Tài Đơn Hàng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarOrders">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('order.index') }}" class="nav-link" data-key="t-analytics">Danh Sách Đơn Hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarVouchers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarVouchers">
                        <i class="ri-price-tag-3-line"></i> <span data-key="t-dashboards">Quản Lý Mã Giảm Giá</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarVouchers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('vouchers.index') }}" class="nav-link" data-key="t-analytics">Danh Sách Mã Giảm Giá</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBlogs" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarBlogs">
                        <i class="ri-bookmark-line"></i> <span data-key="t-dashboards">Quản Lý Blog</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBlogs">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('blog.index') }}" class="nav-link" data-key="t-analytics">Danh Sách Blog</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </li>

        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
