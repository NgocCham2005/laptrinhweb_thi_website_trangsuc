document.addEventListener('DOMContentLoaded', function () {
    console.log("🚀 JS danh mục bảo mật chống bỏ trống ảnh đã hoạt động!");

    const fileInput = document.getElementById('file-cat-1');
    const placeholder = document.getElementById('placeholder-cat-1');
    const previewZone = document.getElementById('preview-cat-1');

    // 1. Hàm dùng chung để xóa ảnh preview
    function clearCurrentPreview() {
        if (fileInput) fileInput.value = ''; 
        if (previewZone) {
            previewZone.innerHTML = '';
            previewZone.style.display = 'none';
        }
        if (placeholder) {
            placeholder.style.display = 'flex';
        }
    }

    // Nút xóa ảnh cũ (nếu có sẵn trên giao diện Sửa)
    const existingBtnDelete = document.getElementById('btn-delete-cat');
    if (existingBtnDelete) {
        existingBtnDelete.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            clearCurrentPreview();
        });
    }

    // 2. Lắng nghe chọn file ảnh mới để tạo preview
    if (fileInput) {
        fileInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewZone.innerHTML = `
                        <div class="preview-item-box">
                            <img src="${e.target.result}" alt="Preview">
                            <span class="img-badge">Ảnh định tải lên</span>
                            <button type="button" class="btn-delete-img" id="btn-delete-cat-new">×</button>
                        </div>
                    `;
                    previewZone.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';

                    // Gắn sự kiện xóa cho ảnh mới
                    const btnDeleteNew = document.getElementById('btn-delete-cat-new');
                    if (btnDeleteNew) {
                        btnDeleteNew.addEventListener('click', function (event) {
                            event.preventDefault();
                            event.stopPropagation();
                            clearCurrentPreview();
                        });
                    }
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // =========================================================
    // 🎯 CHẶN KHÔNG CHO BỎ TRỐNG ẢNH KHI SUBMIT FORM
    // =========================================================
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (event) {
            // Kiểm tra xem vùng previewZone có đang hiển thị ảnh hay không
            // Nếu previewZone đang ẩn (display === 'none'), tức là không có cả ảnh cũ lẫn ảnh mới!
            const isPreviewEmpty = !previewZone || previewZone.style.display === 'none' || previewZone.innerHTML.trim() === '';

            if (isPreviewEmpty) {
                event.preventDefault(); // 🛑 CHẶN ĐỨNG FORM LẠI, KHÔNG CHO GỬI

                // Bắn thông báo cảnh báo trực quan bằng SweetAlert2
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Thiếu hình ảnh!',
                        text: 'Vui lòng tải lên ảnh đại diện cho danh mục sản phẩm trước khi lưu.',
                        confirmButtonText: 'Đồng ý',
                        confirmButtonColor: '#d33'
                    });
                } else {
                    alert("Vui lòng tải lên ảnh đại diện cho danh mục sản phẩm!");
                }
            }
        });
    }
});