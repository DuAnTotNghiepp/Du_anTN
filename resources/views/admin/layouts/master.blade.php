<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('theme/admin/assets/images/favicon.ico') }}">

    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/libs/nouislider/nouislider.min.css') }}">

    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/libs/gridjs/theme/mermaid.min.css') }}">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('theme/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('theme/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('theme/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- jsvectormap css -->
    <link href="{{ asset('theme/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
          type="text/css"/>

    @yield('style-libs')
    <!--Swiper slider css-->


    @yield('style')
</head>

<body>


<!-- Begin page -->
<div id="layout-wrapper">


    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                @yield('content')

            </div> <!-- end .h-100-->

            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include('admin.layouts.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<div class="customizer-setting d-none d-md-block">
    <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
         data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
        <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
    </div>
</div>

<!-- Theme Settings -->


<script>
    const PATH_ROOT = '{{ asset('theme/admin') }}';
</script>
{{-- <script>
    $(document).ready(function() {
    $('.add-btn').on('click', function() {
        console.log('Add Contacts button clicked');
        $('#showModal').modal('show');
    });
});

</script> --}}
<!-- JAVASCRIPT -->
<script src="{{ asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ asset('theme/admin/assets/js/plugins.js') }}"></script>
z
<!-- apexcharts -->
@yield('script-libs')
@yield('scripts')

<!-- App js -->
<script src="{{ asset('theme/admin/assets/js/app.js') }}"></script>

<!-- nouisliderribute js -->
<script src="{{ asset('theme/admin/assets/libs/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/libs/wnumb/wNumb.min.js') }}"></script>

<!-- gridjs js -->
<script src="{{ asset('theme/admin/assets/libs/gridjs/gridjs.umd.js') }}"></script>
<script src="{{ asset('theme/admin/https://unpkg.com/gridjs/plugins/selection/dist/selection.umd.js') }}"></script>
<!-- ecommerce product list -->
<script src="{{ asset('theme/admin/assets/js/pages/ecommerce-product-list.init.js') }}"></script>

</body>

</html>
