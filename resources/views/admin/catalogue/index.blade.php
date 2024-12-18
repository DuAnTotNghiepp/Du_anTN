@extends('admin.layouts.master')

@section('title', 'Danh mục')

@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tiêu đề -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh mục</h4>
            </div>
        </div>
    </div>

    <!-- Bảng danh mục -->
    <div class="row">
        <div class="col-12">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <div class="flex-grow-1">
                                <button class="btn btn-info" id="addCategoryBtn"><i class="ri-add-fill me-1"></i> Thêm danh mục</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Số lượng sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->products_count ?? 0 }}</td>
                                <td>
                                    @if ($category->is_active)
                                        <span class="badge bg-success">Hoạt động</span>
                                    @else
                                        <span class="badge bg-danger">Không hoạt động</span>
                                    @endif
                                </td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <!-- Nút Sửa -->
                                    <button class="btn btn-warning btn-sm editCategoryBtn"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-is_active="{{ $category->is_active }}">
                                        Sửa
                                    </button>

                                    <!-- Nút Xóa -->
                                    <!-- Nút Xóa (ẩn nếu có sản phẩm liên kết) -->
                                    @if ($category->products_count == 0)
                                        <a href="{{ route('admin.destroy', $category->id) }}"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                            Xóa
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-container">

                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal chung -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Thêm danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="categoryForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">
                            <label class="form-check-label" for="is_active">Hoạt động</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const categoryModal = new bootstrap.Modal(document.getElementById('categoryModal'));
            const categoryForm = document.getElementById('categoryForm');
            const modalTitle = document.getElementById('modalTitle');
            const nameInput = document.getElementById('name');
            const isActiveInput = document.getElementById('is_active');
            const methodInput = document.getElementById('method');

            // Mở modal thêm danh mục
            document.getElementById('addCategoryBtn').addEventListener('click', () => {
                modalTitle.textContent = 'Thêm danh mục';
                categoryForm.action = "{{ route('admin.store') }}";
                methodInput.value = 'POST';
                nameInput.value = '';
                isActiveInput.checked = true;
                categoryModal.show();
            });

            // Mở modal sửa danh mục
            document.querySelectorAll('.editCategoryBtn').forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const isActive = button.getAttribute('data-is_active') === '1';

                    modalTitle.textContent = 'Sửa danh mục';
                    categoryForm.action = `/admin/update/${id}`;
                    methodInput.value = 'PUT';
                    nameInput.value = name;
                    isActiveInput.checked = isActive;
                    categoryModal.show();
                });
            });
        });

    </script>
@endsection
