document.addEventListener('DOMContentLoaded', function () {
    // =========================================================
// 1. LOGIC CHẶN FORM KIỂM TRA BỎ TRỐNG TẠI CLIENT
// =========================================================
const adminForm = document.querySelector('form[action*="storeProduct"]') || document.querySelector('form');

if (adminForm) {
    adminForm.addEventListener('submit', function (e) {
        const maSP = document.querySelector('input[name="ma_sanpham"]');
        if (maSP) { 
            const tenSP = document.querySelector('input[name="ten_sanpham"]');
            const danhMuc = document.querySelector('select[name="ma_danhmuc"]');
            const giaBan = document.querySelector('input[name="gia_ban"]');
            const soLuong = document.querySelector('input[name="so_luong_ton"]');
            const hinhAnhChinh = document.getElementById('file-1');

            let errors = [];
            let totalFields = 6;
            let emptyCount = 0;

            // Kiểm tra từng trường và tăng biến đếm nếu trống
            //if (!maSP.value.trim()) { errors.push("Mã sản phẩm không được bỏ trống."); emptyCount++; }
            //if (tenSP && !tenSP.value.trim()) { errors.push("Tên sản phẩm không được bỏ trống."); emptyCount++; }
            //if (danhMuc && !danhMuc.value.trim()) { errors.push("Vui lòng chọn danh mục sản phẩm."); emptyCount++; }
            //if (giaBan && !giaBan.value.trim()) { errors.push("Giá bán không được bỏ trống."); emptyCount++; }
            //if (soLuong && !soLuong.value.trim()) { errors.push("Số lượng tồn kho không được bỏ trống."); emptyCount++; }
            
            if (hinhAnhChinh && hinhAnhChinh.files.length === 0) {
                errors.push("Cần tải lên ít nhất 1 ảnh sản phẩm.");
                emptyCount++;
            }

            // Nếu phát hiện có lỗi thì xử lý ép chặn form
            if (errors.length > 0) {
                e.preventDefault(); 
                
                let titleText = 'Lỗi thêm sản phẩm';
                let errorHtml = '';

                // 🚀 XỬ LÝ THÔNG MINH: Nếu trống toàn bộ 100%
                if (emptyCount === totalFields) {
                    errorHtml = 'Vui lòng nhập đầy đủ thông tin sản phẩm!';
                } else {
                    // Nếu chỉ trống một vài ô thì mới liệt kê gạch đầu dòng
                    errorHtml = errors.map(err => `• ${err}`).join('\n');
                }

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: titleText,
                        text: errorHtml,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#e74c3c'
                    });
                } else {
                    alert(titleText + "\n\n" + errorHtml);
                }
                return false;
            }
        }
    });
}

    const errorContainer = document.getElementById('laravel-errors-data');
    if (errorContainer) {
        const errors = JSON.parse(errorContainer.getAttribute('data-errors') || '[]');
        if (errors.length > 0 && typeof Swal !== 'undefined') {
            let errorMessages = errors.map(error => `• ${error}`).join('\n');
            Swal.fire({ icon: 'error', title: 'Lỗi thêm sản phẩm', text: errorMessages, confirmButtonText: 'Để tôi nhập lại', confirmButtonColor: '#e74c3c' });
        }
    }

    const successContainer = document.getElementById('laravel-success-data');
    if (successContainer) {
        const successMessage = successContainer.getAttribute('data-message');
        if (successMessage && typeof Swal !== 'undefined') {
            Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true }).fire({ icon: 'success', title: successMessage });
        }
    }

    for (let i = 1; i <= 3; i++) {
        const fileInput = document.getElementById(`file-${i}`);
        if (fileInput) {
            fileInput.addEventListener('change', function (e) {
                handlePreview(this, i);
            });
        }
    }
});

function handlePreview(input, id) {
    const boxItem = document.getElementById(`box-${id}`);
    const placeholder = boxItem.querySelector('.upload-box-placeholder');
    const previewZone = boxItem.querySelector('.preview-zone');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewZone.innerHTML = `
                <div class="preview-item-box">
                    <img src="${e.target.result}" alt="Preview">
                    <span class="img-badge">${id === 1 ? 'Ảnh Chính' : 'Ảnh Phụ'}</span>
                    <button type="button" class="btn-delete-img" onclick="clearSingleImage(${id})">×</button>
                </div>
            `;
            previewZone.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';

            if (id < 3) {
                const nextBox = document.getElementById(`box-${id + 1}`);
                if (nextBox && nextBox.style.display === 'none') {
                    nextBox.style.display = 'block';
                }
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function clearSingleImage(id, imageId = null) {
    const input = document.getElementById(`file-${id}`);
    const boxItem = document.getElementById(`box-${id}`);
    const placeholder = boxItem.querySelector('.upload-box-placeholder');
    const previewZone = boxItem.querySelector('.preview-zone');

    if (input) input.value = ''; 
    if (previewZone) {
        previewZone.innerHTML = '';
        previewZone.style.display = 'none';
    }
    if (placeholder) placeholder.style.display = 'flex';

    if (imageId) {
        const container = document.getElementById('deleted-images-container');
        if (container) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'deleted_images[]';
            hiddenInput.value = imageId;
            container.appendChild(hiddenInput);
        }
    }
}