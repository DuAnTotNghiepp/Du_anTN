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
                        <a href="profile" class="active"><i class="flaticon-user"></i> My Profile</a>
                        <a href="order"><i class="flaticon-shopping-bag"></i> My Order</a>
                        <a href="setting"><i class="flaticon-settings"></i> Account Setting</a>
                        <a href="login"><i class="flaticon-logout"></i> Logout</a>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="profile-form-wrapper">
                        <h5>Profile</h5>
                        <div class="profile-top">
                            <div class="user-image">
                                <img src="assets/images/prodil-image.png" alt>
                            </div>
                            <div class="profile-top-btns">
                                <a href="#" class="upload">Upload</a>
                                <a href="#" class="remove">Remove</a>
                            </div>
                        </div>
                        <form action="#" method="POST" id="profile-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="reg-input-group">
                                        <label for="fname">First Name*</label>
                                        <input type="text" id="fname" placeholder="Your first name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="reg-input-group">
                                        <label for="lname">Last Name*</label>
                                        <input type="text" id="lname" placeholder="Your last name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="reg-input-group">
                                        <label for="email">Email *</label>
                                        <input type="email" id="email" placeholder="Your email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="reg-input-group">
                                        <label for="Number">Contact Number *</label>
                                        <input type="tel" id="Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="reg-input-group">
                                        <label for="address">Address *</label>
                                        <input type="text" id="address" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="reg-input-group">
                                        <label for="city">City *</label>
                                        <select id="city">
                                            <option selected>Cumilla</option>
                                            <option value="1">Dhaka</option>
                                            <option value="2">Khulna</option>
                                            <option value="3">Bandarban</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="reg-input-group">
                                        <label for="state">State *</label>
                                        <select id="state">
                                            <option selected>Cumilla</option>
                                            <option value="1">Dhaka</option>
                                            <option value="2">Khulna</option>
                                            <option value="3">Bandarban</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="reg-input-group">
                                        <label for="zip">Zip Code * </label>
                                        <input type="number" id="zip" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="reg-input-group">
                                        <label for="country">Country *</label>
                                        <select id="country">
                                            <option selected>Bangladesh</option>
                                            <option value="1">Japan</option>
                                            <option value="2">Australia</option>
                                            <option value="3">Hawaii</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="reg-input-group">
                                        <label for="password">Password *</label>
                                        <input type="password" id="password" placeholder="Enter a password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="reg-input-group">
                                        <label for="sure-pass">Confirm Password *</label>
                                        <input type="password" id="sure-pass" placeholder="Confirm password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div
                                        class="reg-input-group profile-form-sumbit reg-submit-input d-flex align-items-center">
                                        <input type="submit" id="submite-btn" value="Save Change">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
