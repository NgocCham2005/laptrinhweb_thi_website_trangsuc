// public/js/admin/category-upload.js

document.addEventListener('DOMContentLoaded', function () {
    console.log("🚀 Hệ thống Preview ảnh & Validation Danh mục đã kích hoạt!");

    const categoryForm = document.querySelector('form[action*="storeCategory"]') || document.querySelector('form');
    const fileCat = document.getElementById('file-cat');

    // 1. XỬ LÝ SỰ KIỆN SUBMIT FORM (VALIDATION CLIENT)
    if (categoryForm) {
        categoryForm.addEventListener('submit', function (e) {
            // Xóa sạch các câu báo lỗi đỏ cũ trên giao diện nếu có
            document.querySelectorAll('.inline-error-msg').forEach(el => el.remove());

            const tenDanhMuc = document.querySelector('input[name="ten_danhmuc"]');
            let hasError = false;

            // Hàm tạo chữ đỏ báo lỗi dưới chân input
            function showFieldError(inputElement, message, isImage = false) {
                hasError = true;
                const errorSpan = document.createElement('span');
                errorSpan.className = 'inline-error-msg';
                errorSpan.style.color = '#e74c3c';
                errorSpan.style.fontSize = '13px';
                errorSpan.style.marginTop = '5px';
                errorSpan.style.display = 'block';
                errorSpan.innerText = message;

                if (isImage) {
                    const boxCat = document.getElementById('box-cat');
                    if (boxCat) boxCat.parentNode.appendChild(errorSpan);
                } else if (inputElement) {
                    inputElement.parentNode.appendChild(errorSpan);
                }
            }

            // Kiểm tra tên danh mục trống
            if (tenDanhMuc && !tenDanhMuc.value.trim()) {
                showFieldError(tenDanhMuc, "Tên danh mục không được bỏ trống.");
            }

            // Kiểm tra nếu chưa chọn ảnh (Nếu m bắt buộc danh mục phải có ảnh thì mở đoạn này ra nhé)
            /*
            if (fileCat && fileCat.files.length === 0) {
                showFieldError(null, "Vui lòng tải lên ảnh đại diện cho danh mục.", true);
            }
            */

            if (hasError) {
                e.preventDefault(); // Chặn form không cho reload trang
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi thêm danh mục',
                        text: 'Vui lòng điền đầy đủ thông tin danh mục.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#e74c3c'
                    });
                }
                return false;
            }
        });
    }

    // 2. LOGIC XỬ LÝ PREVIEW (XEM TRƯỚC) ẢNH DANH MỤC
    if (fileCat) {
        fileCat.addEventListener('change', function () {
            const boxCat = document.getElementById('box-cat');
            if (!boxCat) return;

            const placeholder = boxCat.querySelector('.upload-box-placeholder');
            const previewZone = document.getElementById('preview-cat');

            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Render giao diện preview thừa hưởng từ CSS chung của m
                    previewZone.innerHTML = `
                        <div class="preview-item-box">
                            <img src="${e.target.result}" alt="Preview">
                            <span class="img-badge">Ảnh Danh Mục</span>
                            <button type="button" class="btn-delete-img" id="btn-clear-cat">×</button>
                        </div>
                    `;
                    previewZone.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';

                    // Lắng nghe sự kiện bấm nút Xóa ảnh X
                    document.getElementById('btn-clear-cat').addEventListener('click', function() {
                        fileCat.value = ''; // Xóa sạch file trong input
                        previewZone.innerHTML = '';
                        previewZone.style.display = 'none';
                        if (placeholder) placeholder.style.display = 'flex';
                    });
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});