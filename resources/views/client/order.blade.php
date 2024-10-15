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
<a href="dashboard"><i class="flaticon-dashboard"></i> Dashboard</a>
<a href="profile"><i class="flaticon-user"></i> My Profile</a>
<a href="order" class="active"><i class="flaticon-shopping-bag"></i> My Order</a>
<a href="setting"><i class="flaticon-settings"></i> Account Setting</a>
<a href="login"><i class="flaticon-logout"></i> Logout</a>
</div>
</div>
<div class="col-xxl-8 col-xl-8 col-lg-8">
<div class="order-details">
<table class="table order-table mb-0">
<thead>
<tr>
<th scope="col" class="order-id">Order ID</th>
<th scope="col" class="order-date">Order Date</th>
<th scope="col" class="order-status">Status</th>
<th scope="col" class="order-amount">Total</th>
<th scope="col" class="order-active">Active</th>
</tr>
</thead>
<tbody>
<tr>
<td class="order-id">#56986</td>
<td class="order-date">21 August 2021</td>
<td class="order-status">Pending</td>
<td class="order-amount">$ 985.23 for 85 Items</td>
<td class="order-active"><a href="#"><i class="flaticon-visibility"></i></a></td>
</tr>
<tr>
<td class="order-id">#56987</td>
<td class="order-date">25 April 2021</td>
<td class="order-status"> Picked</td>
<td class="order-amount"> $ 985.23 for 85 Items </td>
<td class="order-active"> <a href="#"><i class="flaticon-visibility"></i></a></td>
</tr>
<tr>
<td class="order-id">#56988</td>
<td class="order-date">3rd June 2021</td>
<td class="order-status">Completed</td>
<td class="order-amount">$ 985.23 for 85 Items</td>
<td class="order-active"><a href="#"><i class="flaticon-visibility"></i></a></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
@endsection