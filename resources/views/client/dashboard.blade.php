@extends('client.layouts.app')

@section('content')
<div class="breadcrumb-area ml-110">
<div class="container-fluid p-0">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-bg d-flex justify-content-center align-items-center">
<div class="breadcrumb-shape1 position-absolute top-0 end-0">
<img src="assets/images/shapes/bs-right.png" alt>
</div>
<div class="breadcrumb-shape2 position-absolute bottom-0 start-0">
<img src="assets/images/shapes/bs-left.png" alt>
</div>
<div class="breadcrumb-content text-center">
<h2 class="page-title">My Account</h2>
<ul class="page-switcher d-flex ">
<li><a href="index.html">Home</a> <i class="flaticon-arrow-pointing-to-right"></i></li>
<li>My Account</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="dashbord-wrapper ml-110 mt-100">
<div class="container">
<div class="row">
<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
<div class="dashbord-switcher">
<a href="dashboard.html" class="active"><i class="flaticon-dashboard"></i> Dashboard</a>
<a href="profile"><i class="flaticon-user"></i> My Profile</a>
<a href="order"><i class="flaticon-shopping-bag"></i> My Order</a>
<a href="setting"><i class="flaticon-settings"></i> Account Setting</a>
<a href="login"><i class="flaticon-logout"></i> Logout</a>
</div>
</div>
<div class="col-xxl-8 col-xl-8 col-lg-8">
<div class="dashbord-product-status text-center">
<h5 class="dashbord-title">Hi Cameron Williamson</h5>
<div class="row">
<div class="col-lg-3  col-md-3 col-sm-6 ">
<div class="product-status-single">
<h3>00</h3>
<h5>Pending</h5>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="product-status-single">
<h3>00</h3>
<h5>processing</h5>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="product-status-single">
<h3>00</h3>
<h5>Picked</h5>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 ">
<div class="product-status-single">
<h3>00</h3>
<h5>Complete</h5>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection