@extends('client.profile')
@section('content_profile')
    <div class="col-xxl-8 col-xl-8 col-lg-8">
        <div class="profile-form-wrapper">

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mt-3">PROFILE</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body text-center">
                            <img src="{{ Storage::url($user->img_use ?? 'users/dd.jpg') }}"
                                 alt="User Avatar" style="width: 180px; height: 180px" class="rounded-circle mb-3 img-thumbnail">
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
                                                        {{ $address->commune }},
                                                        {{ $address->state }}, {{ $address->city }}
                                                    </p>
                                                </span>
                                                </th>
                                                <th>
                                                    <!-- Gắn data-attributes vào nút Sửa -->
                                                    <button class="btn edit-address-btn"
                                                            data-id="{{ $address->id }}"
                                                            data-first-name="{{ $address->first_name }}"
                                                            data-last-name="{{ $address->last_name }}"
                                                            data-email="{{ $address->email }}"
                                                            data-contact-number="{{ $address->contact_number }}"
                                                            data-address="{{ $address->address }}"
                                                            data-commune="{{ $address->commune }}"
                                                            data-state="{{ $address->state }}"
                                                            data-city="{{ $address->city }}">
                                                        Sửa
                                                    </button>
                                                </th>
                                                <th>
                                                    <button class="btn">Xóa</button>
                                                </th>
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
                    <form action="{{ route('profile.address.update', ['id' => $address->id ?? '']) }}" method="POST" id="edit-form">
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
                                    <div class="reg-input-group"><label for="city">Tỉnh/Thành phố *</label>
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
                                            required>/-strong/-heart:>:o:-((:-h <option value="">Chọn Thị xã/Xã/Phường</option>
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
                // Lấy danh sách tất cả các nút Sửa
                const editButtons = document.querySelectorAll('.edit-address-btn');
                const editFormContainer = document.getElementById('address-edit-container');

                // Lắng nghe sự kiện click cho từng nút
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Lấy thông tin từ data-attributes
                        const addressId = this.getAttribute('data-id');
                        const firstName = this.getAttribute('data-first-name');
                        const lastName = this.getAttribute('data-last-name');
                        const email = this.getAttribute('data-email');
                        const contactNumber = this.getAttribute('data-contact-number');
                        const address = this.getAttribute('data-address');
                        const commune = this.getAttribute('data-commune');
                        const state = this.getAttribute('data-state');
                        const city = this.getAttribute('data-city');

                        // Hiển thị form
                        editFormContainer.style.display = 'block';

                        // Đổ dữ liệu vào form/-strong/-heart:>:o:-((:-h document.getElementById('fname').value = firstName;
                        document.getElementById('lname').value = lastName;
                        document.getElementById('email').value = email;
                        document.getElementById('Number').value = contactNumber;
                        document.getElementById('address').value = address;
                        document.getElementById('commune').value = commune;
                        document.getElementById('state').value = state;
                        document.getElementById('city').value = city;

                        // Cập nhật URL của form với ID địa chỉ
                        const form = document.getElementById('edit-form');
                        form.action = `/profile/address/update/${addressId}`;
                    });
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
                                                <option value="Hải Phòng">Hải Phòng</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="reg-input-group">
                                            <label for="commune">Thị xã/Xã/Phường *</label>
                                            <select id="commune" name="commune" class="form-control"
                                                    required>
                                                <option value="">Chọn Thị xã/Xã/Phường</option>
                                                <option value="Hải Phòng">Hải Phòng</option>
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
@endsection
