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
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="flaticon-logout"></i>Logout
                            </a>

                        </div>
                    </div>
                    <div class="col-xxl-8 col-xl-8 col-lg-8">
                        <div class="profile-form-wrapper">

                            <div class="container mt-5">
                                <div class="card">
                                    <div class="card-header text-white">
                                        <h5 class="mt-3">PROFILE</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body text-center">
                                            <img src="{{ $user->img_use ?? 'https://via.placeholder.com/100' }}"
                                                alt="User Avatar" class="rounded-circle mb-3 img-thumbnail">

                                            <h5 id="user-name" class="fw-bold ">{{ $user->name }}</h5>
                                        </div>
                                        <div class="mb-3">
                                            <label for="user-email" class="form-label">EMAIL CỦA BẠN:</label>
                                            <h5 id="user-email" class="fw-bold">{{ $user->email }}</h5>
                                        </div>
                                        <div class="mb-3">
                                            <label for="join-date" class="form-label">NGÀY THAM GIA:</label>
                                            <h5 id="join-date" class="fw-bold">{{ $user->created_at->format('d/m/Y') }}</h5>
                                        </div>
                                        <div class="mb-3">
                                            <div id="address-info" class="card mb-4 shadow-sm">
                                                <div class="card-header">
                                                    <h5>Địa chỉ</h5>
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($addresses as $address)
                                                        @if ($address)
                                                            <table>
                                                                <th>
                                                                    <span id="user-address" class="fw-bold">
                                                                        <p>Số điện thoại: {{ $address->contact_number }}</p>
                                                                        <p>Địa chỉ: {{ $address->first_name }}
                                                                            {{ $address->last_name }},
                                                                            {{ $address->address }},
                                                                            {{ $address->commune }}, {{ $address->state }},
                                                                            {{ $address->city }}</p>

                                                                    </span>
                                                                </th>
                                                                <th><button id="edit-address-btn" class="btn ">Chỉnh
                                                                        sửa</button></th>
                                                            </table>
                                                        @else
                                                            <p class="text-muted">Bạn chưa thêm địa chỉ.</p>
                                                            <button class="btn btn-primary" id="add-address-btn">Thêm địa
                                                                chỉ</button>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="btn-submit">
                                                    <!-- Nút để hiển thị/ẩn form -->
                                                    <button id="toggle-form-btn" class="btn float-end m-3">Thêm
                                                        Địa Chỉ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Form chỉnh sửa địa chỉ -->
                            <div id="address-edit-container" class="container mt-5" style="display: none;">
                                <div class="card">
                                    <div class="card-header text-white">
                                        <h5 class="mt-3">CHỈNH SỬA ĐỊA CHỈ</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('profile.address.store', $address->id ?? '') }}"
                                            method="POST" id="edit-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="reg-input-group">
                                                        <label for="fname">First Name*</label>
                                                        <input type="text" name="first_name" id="fname"
                                                            placeholder="Your first name"
                                                            value="{{ old('first_name', $address->first_name ?? '') }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="reg-input-group">
                                                        <label for="lname">Last Name*</label>
                                                        <input type="text" name="last_name" id="lname"
                                                            placeholder="Your last name"
                                                            value="{{ old('last_name', $address->last_name ?? '') }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="reg-input-group">
                                                        <label for="email">Email *</label>
                                                        <input type="email" name="email" id="email"
                                                            placeholder="Your email"
                                                            value="{{ old('email', $address->email ?? '') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="reg-input-group">
                                                        <label for="Number">Contact Number *</label>
                                                        <input type="tel" name="contact_number" id="Number"
                                                            value="{{ old('contact_number', $address->contact_number ?? '') }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="reg-input-group">
                                                            <label for="city">Tỉnh/Thành phố *</label>
                                                            <select id="city" name="city" class="form-control"
                                                                required>
                                                                <option value="">Chọn Tỉnh/Thành phố</option>
                                                                <option value="Hà Nội"
                                                                    {{ old('city', $address->city ?? '') == 'Hà Nội' ? 'selected' : '' }}>
                                                                    Hà Nội</option>
                                                                <option value="TP HCM"
                                                                    {{ old('city', $address->city ?? '') == 'TP HCM' ? 'selected' : '' }}>
                                                                    TP HCM</option>
                                                                <option value="Đà Nẵng"
                                                                    {{ old('city', $address->city ?? '') == 'Đà Nẵng' ? 'selected' : '' }}>
                                                                    Đà Nẵng</option>
                                                                <option value="Hải Phòng"
                                                                    {{ old('city', $address->city ?? '') == 'Hải Phòng' ? 'selected' : '' }}>
                                                                    Hải Phòng</option>
                                                                <option value="Cần Thơ"
                                                                    {{ old('city', $address->city ?? '') == 'Cần Thơ' ? 'selected' : '' }}>
                                                                    Cần Thơ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="reg-input-group">
                                                            <label for="state">Quận/Huyện *</label>
                                                            <select id="state" name="state" class="form-control"
                                                                required>
                                                                <option value="">Chọn Quận/Huyện</option>
                                                                <option value="{{ old('state', $address->state ?? '') }}"
                                                                    selected>
                                                                    {{ old('state', $address->state ?? '---') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="reg-input-group">
                                                            <label for="commune">Thị xã/Xã/Phường *</label>
                                                            <select id="commune" name="commune" class="form-control"
                                                                required>
                                                                <option value="">Chọn Thị xã/Xã/Phường</option>
                                                                <option
                                                                    value="{{ old('commune', $address->commune ?? '') }}"
                                                                    selected>
                                                                    {{ old('commune', $address->commune ?? '---') }}
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="reg-input-group">
                                                        <label for="address">Address *</label>
                                                        <input type="text" name="address" id="address"
                                                            value="{{ old('address', $address->address ?? '') }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div
                                                        class="reg-input-group profile-form-sumbit reg-submit-input d-flex align-items-center">
                                                        <input type="submit" id="submit-btn" value="Save Changes">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const editButton = document.getElementById('edit-address-btn');
                                    const editFormContainer = document.getElementById('address-edit-container');

                                    editButton.addEventListener('click', function() {
                                        const isVisible = editFormContainer.style.display === 'block';
                                        editFormContainer.style.display = isVisible ? 'none' : 'block';
                                    });
                                });
                            </script>

                            <!-- Form thêm địa chỉ -->
                            <div id="address-form-container" class="container mt-5" style="display: none;">
                                <div class="card">
                                    <div class="card-header text-white">
                                        <h5 class="mt-3">THÊM ĐỊA CHỈ</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('profile.address.store') }}" method="POST"
                                            id="profile-form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="reg-input-group">
                                                        <label for="fname">First Name*</label>
                                                        <input type="text" name="first_name" id="fname"
                                                            placeholder="Your first name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="reg-input-group">
                                                        <label for="lname">Last Name*</label>
                                                        <input type="text" name="last_name" id="lname"
                                                            placeholder="Your last name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="reg-input-group">
                                                        <label for="email">Email *</label>
                                                        <input type="email" name="email" id="email"
                                                            placeholder="Your email" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="reg-input-group">
                                                        <label for="Number">Contact Number *</label>
                                                        <input type="tel" name="contact_number" id="Number"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="reg-input-group">
                                                            <label for="city">Tỉnh/Thành phố *</label>
                                                            <select id="city" name="city" class="form-control"
                                                                required>
                                                                <option value="">Chọn Tỉnh/Thành phố</option>
                                                                <option value="Hà Nội">Hà Nội</option>
                                                                <option value="TP HCM">TP HCM</option>
                                                                <option value="Đà Nẵng">Đà Nẵng</option>
                                                                <option value="Hải Phòng">Hải Phòng</option>
                                                                <option value="Cần Thơ">Cần Thơ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="reg-input-group">
                                                            <label for="state">Quận/Huyện *</label>
                                                            <select id="state" name="state" class="form-control"
                                                                required>
                                                                <option value="">Chọn Quận/Huyện</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="reg-input-group">
                                                            <label for="commune">Thị xã/Xã/Phường *</label>
                                                            <select id="commune" name="commune" class="form-control"
                                                                required>
                                                                <option value="">Chọn Thị xã/Xã/Phường</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="reg-input-group">
                                                        <label for="address">Address *</label>
                                                        <input type="text" name="address" id="address" required>
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
                            <script>
                                document.getElementById('toggle-form-btn').addEventListener('click', function() {
                                    const formContainer = document.getElementById('address-form-container');
                                    formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
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
                    statesBycity[selectedcity][selectedstate].forEach(function(ward) {
                        const option = document.createElement('option');
                        option.value = ward;
                        option.textContent = ward;
                        wardSelect.appendChild(option);
                    })
                }
            });
        });
    </script>
