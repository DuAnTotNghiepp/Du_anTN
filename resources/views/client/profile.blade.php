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
                            <a href="{{ route('profile', ['id' => auth()->user()->id]) }}" ><i
                                    class="flaticon-user"></i> My Profile</a>
                            <a href="{{ route('my_orders',['id' => auth()->user()->id])}}" ><i
                                 class="flaticon-shopping"></i> My Order</a>
                            <a href="setting"><i class="flaticon-settings"></i> Account Setting</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="flaticon-logout"></i>Logout
                            </a>

                        </div>
                    </div>
                   @yield('content_profile')
                </div>
            </div>
        </div>
        <script>
            window.history.pushState(null, "", window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, "", window.location.href);
            };
            document.addEventListener('DOMContentLoaded', function() {
                const statesBycity = {
                    "Hà Nội": {
                        "Ba Đình": ["Phường Liễu Giai", "Phường Ngọc Hà", "Phường Trúc Bạch"],
                        "Hoàn Kiếm": ["Phường Cửa Đông", "Phường Hàng Trống", "Phường Hàng Gai"],
                        // Thêm các quận/huyện và xã/phường khác của Hà Nội
                    },
                    "TP HCM": {
                        "Quận 1": ["Phường Bến Nghé", "Phường Bến Thành", "Phường Cô Giang"],
                        "Quận 3": ["Phường 6", "Phường 7", "Phường 8"],
                        // Thêm các quận/huyện và xã/phường khác của TP HCM
                    },
                    "Đà Nẵng": {
                        "Hải Châu": ["Phường Hòa Thuận Đông", "Phường Bình Thuận"],
                        "Sơn Trà": ["Phường Thọ Quang", "Phường An Hải Bắc"],
                        // Thêm các quận/huyện và xã/phường khác của Đà Nẵng
                    },
                    "Hải Phòng": {
                        "Hồng Bàng": ["Phường Quán Toan", "Phường Sở Dầu"],
                        "Lê Chân": ["Phường An Biên", "Phường Cát Dài"],
                        // Thêm các quận/huyện và xã/phường khác của Hải Phòng
                    },
                    "Cần Thơ": {
                        "Ninh Kiều": ["Phường Tân An", "Phường An Bình"],
                        "Bình Thủy": ["Phường Trà Nóc", "Phường Long Hòa"],
                        // Thêm các quận/huyện và xã/phường khác của Cần Thơ
                    },
                    "An Giang": {
                        "Long Xuyên": ["Phường Bình Khánh", "Phường Mỹ Bình"],
                        "Châu Đốc": ["Phường Núi Sam", "Phường Vĩnh Mỹ"],
                        // Thêm các quận/huyện và xã/phường khác của An Giang
                    },
                    "Bà Rịa - Vũng Tàu": {
                        "Vũng Tàu": ["Phường Thắng Tam", "Phường Thắng Nhì"],
                        "Bà Rịa": ["Phường Phước Hiệp", "Phường Long Tâm"],
                        // Thêm các quận/huyện và xã/phường khác của Bà Rịa - Vũng Tàu
                    },
                    // Thêm các tỉnh thành khác...
                };

                const citySelect = document.getElementById('city');
                const stateSelect = document.getElementById('state');
                const wardSelect = document.getElementById('commune');

                // Cập nhật danh sách Quận/Huyện khi chọn Tỉnh/Thành phố
                citySelect.addEventListener('change', function() {
                    const selectedcity = citySelect.value;
                    stateSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                    wardSelect.innerHTML = '<option value="">Chọn Thị xã/Xã/Phường</option>';

                    if (selectedcity && statesBycity[selectedcity]) {
                        Object.keys(statesBycity[selectedcity]).forEach(function(state) {
                            const option = document.createElement('option');
                            option.value = state;
                            option.textContent = state;
                            stateSelect.appendChild(option);
                        });
                    }
                });

                // Cập nhật danh sách Thị xã/Xã/Phường khi chọn Quận/Huyện
                stateSelect.addEventListener('change', function() {
                    const selectedcity = citySelect.value;
                    const selectedstate = stateSelect.value;
                    wardSelect.innerHTML = '<option value="">Chọn Thị xã/Xã/Phường</option>';

                    if (selectedstate && statesBycity[selectedcity][selectedstate]) {
                        statesBycity[selectedcity][selectedstate].forEach(function(commune) {
                            const option = document.createElement('option');
                            option.value = commune;
                            option.textContent = commune;
                            wardSelect.appendChild(option);
                        })
                    }
                });
            });
        </script>
    @endsection
