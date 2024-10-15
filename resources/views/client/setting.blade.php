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
<div class="col-xxl-4 col-xl-3 col-lg-4 col-md-12">
<div class="dashbord-switcher">
<a href="dashboard"><i class="flaticon-dashboard"></i> Dashboard</a>
<a href="profile"><i class="flaticon-user"></i> My Profile</a>
<a href="order"><i class="flaticon-shopping-bag"></i> My Order</a>
<a href="setting" class="active"><i class="flaticon-settings"></i> Account Setting</a>
<a href="login"><i class="flaticon-logout"></i> Logout</a>
</div>
</div>
<div class="col-xxl-8 col-lg-8">
<div class="account-sitting-wrapper">
<div class="row">
<div class="col-lg-6 col-md-6">
<div class="billing-card">
<h5 class="card-title">Billing Address</h5>
<ul class="card-list">
<li><span>First Name <small>:</small></span>Cameron </li>
<li><span>Last Name <small>:</small></span>Williamson </li>
<li><span>Address <small>:</small></span>Eight Avenue 487, London </li>
<li><span>Post code <small>:</small></span> 096895 </li>
<li><span>Country <small>:</small></span>London </li>
</ul>
</div>
</div>
<div class="col-lg-6 col-md-6">
<div class="shipping-card">
<h5 class="card-title">Billing Address</h5>
<ul class="card-list">
<li><span>First Name <small>:</small></span>Cameron </li>
<li><span>Last Name <small>:</small></span>Williamson </li>
<li><span>Address <small>:</small></span>Eight Avenue 487, London </li>
<li><span>Post code <small>:</small></span> 096895 </li>
<li><span>Country <small>:</small></span>London </li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection