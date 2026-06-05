@extends('layouts.admin')

@section('title', 'Khách hàng')

@section('page-title', 'Quản lý khách hàng')

@section('content')


{{-- HEADER --}}
<div class="page-header">
    <h3>Danh sách khách hàng</h3>
</div>

{{-- THANH BỘ LỌC MỚI (Thay thế khối tìm kiếm cũ) --}}
<div class="product-inline-filter" style="margin-bottom: 20px;">
    <form method="GET" action="/admin/customers" class="filter-flex-container">
        
        {{-- Ô tìm kiếm từ khóa --}}
        <div class="filter-field field-search" style="max-width: 320px;">
            <input
                type="text"
                name="keyword"
                class="filter-input-control"
                placeholder="Tìm theo mã, tên, username, email..."
                value="{{ request('keyword') }}"
            >
        </div>

        {{-- SỬA TẠI FILE VIEW customers.blade.php --}}
<div class="filter-field" style="max-width: 200px;">
    <select name="status" class="filter-input-control">
        <option value="">-- Tất cả trạng thái --</option>
        
        {{-- SỬA LẠI: Hoạt động phải là value="1" --}}
        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Hoạt động</option>
        
        {{-- SỬA LẠI: Đã khóa phải là value="0" --}}
        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Đã khóa</option>
        
    </select>
</div>

        {{-- Cụm nút bấm hành động --}}
<div class="filter-buttons-group">
    
    {{-- CHỈ GIỮ LẠI DUY NHẤT 1 NÚT NÀY: Bỏ nút "Tìm kiếm" cũ đi, dùng nút này để gửi cả từ khóa và trạng thái lên Server --}}
<button type="submit" class="btn btn-secondary">Tra cứu</button>    
    {{-- Hiện nút Xóa bộ lọc nếu đang có tìm kiếm hoặc lọc trạng thái --}}
    @if(request('keyword') || request('status') !== null && request('status') !== '')
<a href="/admin/customers" class="btn btn-primary" style="text-decoration: none; margin-left: 8px;">Xóa bộ lọc</a>
    @endif

</div>
    </form>
</div>

{{-- TABLE --}}
<x-table
    :headers="['Mã TK', 'Họ tên', 'Tên đăng nhập', 'Email', 'Trạng thái', 'Thao tác']"
    striped
>
    @forelse($users as $user)
        <tr>
            <td>{{ $user->MaTaiKhoan }}</td>
            <td>{{ $user->HoTen }}</td>
            <td>{{ $user->TenDangNhap }}</td>
            <td>{{ $user->Email }}</td>
            <td>
                @if($user->TrangThai == 1)
                    <span class="badge badge-success">Hoạt động</span>
                @else
                    <span class="badge badge-danger">Đã khóa</span>
                @endif
            </td>
            <td class="action-col">
                <div class="action-buttons">
                    <a href="/admin/customers/{{ $user->MaTaiKhoan }}">
                        <x-button>Chi tiết</x-button>
                    </a>
                    
                    {{-- THAY ĐỔI: Chuyển thẻ <a> cũ thành <button> để kích hoạt Modal thông qua JS --}}
                    {{-- Sử dụng class .btn phối với .btn-danger/.btn-primary ăn theo cấu trúc CSS của bạn --}}
                    <button 
                        type="button" 
                        class="btn {{ $user->TrangThai == 1 ? 'btn-danger' : 'btn-primary' }}" 
                        onclick="confirmToggleAccount('{{ $user->MaTaiKhoan }}', '{{ $user->HoTen }}', '{{ $user->TrangThai }}')"
                    >
                        {{ $user->TrangThai == 1 ? 'Khóa' : 'Mở khóa' }}
                    </button>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" style="text-align: center; color: #94a3b8;">Không có dữ liệu</td>
        </tr>
    @endforelse
</x-table>

{{-- PAGINATION --}}
<x-pagination :paginator="$users"/>


{{-- 2. CẤU TRÚC MODAL (Được dựng chuẩn 100% theo các class modal trong form.css của bạn) --}}
<div class="modal-backdrop" id="confirmModal">
    <div class="modal">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Xác nhận</h5>
            <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body" id="modalMessage">
            Bạn có chắc chắn muốn thay đổi trạng thái tài khoản này không?
        </div>
        <div class="modal-footer">
            {{-- Nút hủy sử dụng class .btn-ghost có sẵn trong form.css --}}
            <button type="button" class="btn btn-ghost" onclick="closeModal()">Hủy bỏ</button>
            
            <form id="confirmForm" method="GET" action="">
                {{-- Nút xác nhận sẽ tự động gán class màu chuẩn (btn-danger hoặc btn-primary) bằng JS tùy theo hành động --}}
                <button type="submit" class="btn" id="btnSubmitModal">Xác nhận</button>
            </form>
        </div>
    </div>
</div>


{{-- 3. JAVASCRIPT XỬ LÝ ĐÓNG/MỞ MODAL VÀ TỰ ĐỘNG ẨN ALERT --}}
<script>
    // Hàm mở modal và đổ dữ liệu động theo từng khách hàng
    function confirmToggleAccount(maTaiKhoan, hoTen, trangThai) {
        const backdrop = document.getElementById('confirmModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const confirmForm = document.getElementById('confirmForm');
        const btnSubmitModal = document.getElementById('btnSubmitModal');

        // Nếu trạng thái hiện tại là 1 (Đang hoạt động) -> Hiện giao diện KHÓA
        if (trangThai == 1) {
            modalTitle.innerText = "Khóa tài khoản khách hàng";
            modalMessage.innerHTML = `Bạn có chắc chắn muốn <b>KHÓA</b> tài khoản của khách hàng <strong>${hoTen}</strong> (Mã: ${maTaiKhoan}) không?`;
            btnSubmitModal.innerText = "Khóa tài khoản";
            btnSubmitModal.className = "btn btn-danger"; // Gán class nút đỏ từ form.css
        } else {
            // Ngược lại -> Hiện giao diện MỞ KHÓA
            modalTitle.innerText = "Mở khóa tài khoản";
            modalMessage.innerHTML = `Bạn có chắc chắn muốn <b>MỞ KHÓA</b> tài khoản của khách hàng <strong>${hoTen}</strong> (Mã: ${maTaiKhoan}) không?`;
            btnSubmitModal.innerText = "Mở khóa";
            btnSubmitModal.className = "btn btn-primary"; // Gán class nút vàng gold từ form.css
        }

        // Cập nhật thuộc tính action của form trỏ đến hàm toggle trong Controller
        confirmForm.action = `/admin/customers/toggle/${maTaiKhoan}`;

        // Kích hoạt hiển thị modal bằng class .open (Khớp với CSS: .modal-backdrop.open)
        backdrop.classList.add('open');
    }

    // Hàm đóng modal
    function closeModal() {
        document.getElementById('confirmModal').classList.remove('open');
    }

    // Đóng modal nếu click trúng vùng nền mờ phía ngoài hộp thoại
    window.onclick = function(event) {
        const backdrop = document.getElementById('confirmModal');
        if (event.target === backdrop) {
            backdrop.classList.remove('open');
        }
    }

    // Tự động làm mờ và ẩn Alert thông báo sau 4 giây cho gọn màn hình
    document.addEventListener("DOMContentLoaded", function() {
        const alert = document.getElementById('system-alert');
        if (alert) {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500); // Xóa hẳn khỏi HTML sau khi mờ xong
            }, 4000);
        }
    });
</script>

@endsection