@extends('client.profile')
@section('content_profile')
<style>
    .card-body {
    overflow-x: auto;
    max-width: 100%;
}

</style>
    <div class="col-xxl-8 col-xl-8 col-lg-8">
        <div class="profile-form-wrapper">

            <div class="container mt-5">
                <div class="card">
                    <div class="card-header text-white">
                        <h5 class="mt-3">PROFILE</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body text-center">
                            <img src="{{ $user->img_use ? Storage::url($user->img_use) : asset('image/dd.jpg') }}"
                                alt="User Avatar" style="width: 180px; height: 180px; cursor: pointer;"
                                class="rounded-circle mb-3 img-thumbnail" data-bs-toggle="modal"
                                data-bs-target="#viewAvatarModal">

                            <!-- Modal để xem ảnh đại diện -->
                            <div class="modal fade" id="viewAvatarModal" tabindex="-1"
                                aria-labelledby="viewAvatarModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewAvatarModalLabel">Ảnh đại diện</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ $user->img_use ? Storage::url($user->img_use) : asset('image/dd.jpg') }}"
                                                alt="User Avatar" class="img-fluid rounded">
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Nút mở modal cập nhật ảnh -->
                                            <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                                data-bs-target="#updateAvatarModal">
                                                Cập nhật ảnh đại diện
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal cập nhật ảnh đại diện -->
                            <div class="modal fade" id="updateAvatarModal" tabindex="-1"
                                aria-labelledby="updateAvatarModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateAvatarModalLabel">Cập nhật ảnh đại diện</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/user/update-avatar') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="avatar">Chọn ảnh đại diện:</label>
                                                    <input type="file" name="avatar" id="avatar"
                                                        class="form-control">
                                                </div>
                                                <button type="submit" class="btn btn-dark mt-3">Cập nhật</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                    <table>
                                        <tr>
                                            <th>Information</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                        @foreach ($addresses as $address)
                                            @if ($address)
                                                <tr>
                                                    <td>
                                                        <span id="user-address">
                                                            <p>Số điện thoại: {{ $address->contact_number }}</p>
                                                            <p>Địa chỉ:
                                                                {{ $address->commune }},
                                                                {{ $address->state }}, {{ $address->city }},
                                                                {{ $address->address }}
                                                            </p>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn edit-address-btn" data-bs-toggle="modal"
                                                            data-bs-target="#editAddressModal"
                                                            data-id="{{ $address->id }}"
                                                            data-first-name="{{ $address->first_name }}"
                                                            data-last-name="{{ $address->last_name }}"
                                                            data-email="{{ $address->email }}"
                                                            data-contact-number="{{ $address->contact_number }}"
                                                            data-city="{{ $address->city }}"
                                                            data-district="{{ $address->state }}"
                                                            data-ward="{{ $address->commune }}"
                                                            data-address="{{ $address->address }}"
                                                            data-city-name="{{ $address->city_name }}"
                                                            data-district-name="{{ $address->state_name }}"
                                                            data-ward-name="{{ $address->commune_name }}">
                                                            Sửa
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('address.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn">Xóa</button>
                                                        </form>                                                        
                                                    </td>
                                                </tr>
                                            @else
                                                <p class="text-muted">Bạn chưa thêm địa chỉ.</p>
                                                <button class="btn btn-primary" id="add-address-btn">Thêm địa
                                                    chỉ</button>
                                            @endif
                                        @endforeach
                                    </table>


                                </div>
                                <div class="btn-submit">
                                    <!-- Nút để hiển thị/ẩn form -->
                                    <button class="btn float-end" id="add-address-btn">Thêm Địa Chỉ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form chỉnh sửa địa chỉ -->
            <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('profile.address.update' ,'.', ['id' => $address->id ?? '']) }}" method="POST"
                            id="editAddressForm">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAddressLabel">Chỉnh Sửa Địa Chỉ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form các trường chỉnh sửa địa chỉ -->
                                <input type="hidden" id="editAddressId" name="id">
                                <div class="mb-3">
                                    <label for="editFirstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="editFirstName" name="first_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="editLastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="editLastName" name="last_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="editEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="editEmail" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editContactNumber" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="editContactNumber"
                                        name="contact_number" required>
                                </div>
                                <div>
                                    <label class="form-label">City</label>
                                    <select class="form-select form-select-sm mb-3" id="editCity" name="city">
                                        <option value="" selected>Select province</option>
                                    </select>
                                    <label class="form-label">District</label>
                                    <select class="form-select form-select-sm mb-3" id="editDistrict" name="state">
                                        <option value="" selected>Select district</option>
                                    </select>
                                    <label class="form-label">Ward</label>
                                    <select class="form-select form-select-sm" id="editWard" name="commune">
                                        <option value="" selected>Select ward</option>
                                    </select>
                                    <input type="hidden" id="editCityName" name="city_name">
                                    <input type="hidden" id="editDistrictName" name="state_name">
                                    <input type="hidden" id="editWardName" name="commune_name">
                                </div>
                                <div class="mb-3">
                                    <label for="editAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="editAddress" name="address" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-dark">Cập Nhật Địa Chỉ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Chọn tất cả nút chỉnh sửa
                    const editButtons = document.querySelectorAll('.edit-address-btn');
                    const editForm = document.getElementById('editAddressForm');

                    editButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            // Lấy dữ liệu từ nút
                            const id = this.dataset.id;
                            const firstName = this.dataset.firstName;
                            const lastName = this.dataset.lastName;
                            const email = this.dataset.email;
                            const contactNumber = this.dataset.contactNumber;
                            const city = this.dataset.city;
                            const district = this.dataset.district;
                            const ward = this.dataset.ward;
                            const address = this.dataset.address;

                            // Gán dữ liệu vào Modal
                            document.getElementById('editAddressId').value = id;
                            document.getElementById('editFirstName').value = firstName;
                            document.getElementById('editLastName').value = lastName;
                            document.getElementById('editEmail').value = email;
                            document.getElementById('editContactNumber').value = contactNumber;
                            document.getElementById('editCity').value = city;
                            document.getElementById('editDistrict').value = district;
                            document.getElementById('editWard').value = ward;
                            document.getElementById('editAddress').value = address;

                            // Cập nhật action của form
                            editForm.action =
                                `{{ route('profile.address.update' ,'.', ['id' => $address->id ?? '']) }}`
                                .replace('?', id);
                        });
                    });
                });
            </script>
            <!-- Form thêm địa chỉ -->
            <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('profile.address.store') }}"  method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAddressLabel">Thêm Địa Chỉ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Form các trường thêm địa chỉ -->
                               <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="addFirstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="addFirstName" name="first_name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="addLastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="addLastName" name="last_name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="addEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="addEmail" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="addContactNumber" class="form-label">Contact Number</label>
                                        <input type="tel" class="form-control" id="addContactNumber"
                                            name="contact_number" required>
                                    </div>
                                   </div>
                                  <div class="col-6">
                                    <div>
                                        <label class="form-label">City</label>
                                        <select class="form-select form-select-sm mb-3" id="city" name="city">
                                            <option value="" selected>Select province</option>
                                        </select>
                                        <label class="form-label">District</label>
                                        <select class="form-select form-select-sm mb-3" id="district" name="state">
                                            <option value="" selected>Select district</option>
                                        </select>
                                        <label class="form-label">Ward</label>
                                        <select class="form-select form-select-sm" id="ward" name="commune">
                                            <option value="" selected>Select ward</option>
                                        </select>
                                        <!-- Input ẩn để lưu tên tỉnh, huyện, xã -->
                                        <input type="hidden" id="city_name" name="city">
                                        <input type="hidden" id="district_name" name="state">
                                        <input type="hidden" id="ward_name" name="commune">
    
                                    </div>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
                                    <script>
                                        var citis = document.getElementById("city");
                                        var districts = document.getElementById("district");
                                        var wards = document.getElementById("ward");
                                        var Parameter = {
                                            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
                                            method: "GET",
                                            responseType: "application/json",
                                        };
    
                                        axios(Parameter)
                                            .then(function(result) {
                                                console.log("Dữ liệu JSON tải thành công:", result.data); // Kiểm tra dữ liệu tải về
                                                renderCity(result.data);
                                            })
                                            .catch(function(error) {
                                                console.error("Không thể tải dữ liệu:", error);
                                            });
    
                                        function renderCity(data) {
                                            for (const x of data) {
                                                citis.options[citis.options.length] = new Option(x.Name, x.Id);
                                            }
                                            citis.onchange = function() {
                                                districts.length = 1;
                                                wards.length = 1;
                                                if (this.value != "") {
                                                    const result = data.filter(n => n.Id === this.value);
                                                    for (const k of result[0].Districts) {
                                                        districts.options[districts.options.length] = new Option(k.Name, k.Id);
                                                    }
                                                }
                                            };
                                            document.getElementById("city").addEventListener("change", function() {
                                                const cityName = this.options[this.selectedIndex].text; // Lấy tên tỉnh/thành
                                                document.getElementById("city_name").value = cityName; // Gán vào input ẩn
                                            });
    
                                            document.getElementById("district").addEventListener("change", function() {
                                                const districtName = this.options[this.selectedIndex].text; // Lấy tên quận/huyện
                                                document.getElementById("district_name").value = districtName; // Gán vào input ẩn
                                            });
    
                                            document.getElementById("ward").addEventListener("change", function() {
                                                const wardName = this.options[this.selectedIndex].text; // Lấy tên xã/phường
                                                document.getElementById("ward_name").value = wardName; // Gán vào input ẩn
                                            });
    
                                            districts.onchange = function() {
                                                wards.length = 1;
                                                const dataCity = data.filter((n) => n.Id === citis.value);
                                                if (this.value != "") {
                                                    const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;
                                                    for (const w of dataWards) {
                                                        wards.options[wards.options.length] = new Option(w.Name, w.Id);
                                                    }
                                                }
                                            };
                                        }
                                    </script>
                                    <div class="mt-3">
                                        <label for="addAddress" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="addAddress" name="address" required>
                                    </div>
                                  </div>
                               </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-dark">Thêm Địa Chỉ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById('add-address-btn').addEventListener('click', function() {
                    const addModal = new bootstrap.Modal(document.getElementById('addAddressModal'));
                    addModal.show();
                });
                document.querySelectorAll('.edit-button').forEach(button => {
                    button.addEventListener('click', function() {
                        const addressId = this.getAttribute('data-id');

                        // Giả sử bạn có API trả về thông tin địa chỉ
                        axios.get(`/api/addresses/${addressId}`).then(response => {
                            const address = response.data;
                            document.getElementById('editFirstName').value = address.first_name;
                            document.getElementById('editLastName').value = address.last_name;
                            document.getElementById('editEmail').value = address.email;
                            document.getElementById('editContactNumber').value = address.contact_number;
                            document.getElementById('editAddress').value = address.address;

                            // Tải dữ liệu tỉnh, quận, xã nếu cần
                            document.getElementById('editCityName').value = address.city_name;
                            document.getElementById('editDistrictName').value = address.state_name;
                            document.getElementById('editWardName').value = address.commune_name;
                        });
                    });

                    // document.getElementById('toggle-form-btn').addEventListener('click', function() {
                    //     const formContainer = document.getElementById('address-form-container');
                    //     formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
                    // });
                });
            </script>
        </div>
    </div>
@endsection
