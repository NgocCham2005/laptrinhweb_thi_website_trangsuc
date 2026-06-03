document.addEventListener('DOMContentLoaded', function () {
    console.log("🚀 Hệ thống Inline Validation & Popup đã đồng bộ hoàn hảo!");

    // =========================================================
    // 1. LOGIC KIỂM TRA FORM & BẮN LỖI NGAY TẠI TRƯỜNG NHẬP LIỆU (CLIENT)
    // =========================================================
    const adminForm = document.querySelector('form[action*="storeProduct"]') || document.querySelector('form');
    
    if (adminForm) {
        adminForm.addEventListener('submit', function (e) {
            // Xóa sạch các câu báo lỗi đỏ cũ trên giao diện
            document.querySelectorAll('.inline-error-msg').forEach(el => el.remove());

            const maSP = document.querySelector('input[name="ma_sanpham"]');
            const tenSP = document.querySelector('input[name="ten_sanpham"]');
            const danhMuc = document.querySelector('select[name="ma_danhmuc"]');
            const giaBan = document.querySelector('input[name="gia_ban"]');
            const chatLieu = document.querySelector('input[name="chat_lieu"]');
            const hinhAnhChinh = document.getElementById('file-1');

            let hasError = false;

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
                    const uploadGrid = document.getElementById('uploadGrid');
                    if (uploadGrid) uploadGrid.parentNode.appendChild(errorSpan);
                } else if (inputElement) {
                    inputElement.parentNode.appendChild(errorSpan);
                }
            }

            if (maSP && !maSP.value.trim()) showFieldError(maSP, "Mã sản phẩm không được bỏ trống.");
            if (tenSP && !tenSP.value.trim()) showFieldError(tenSP, "Tên sản phẩm không được bỏ trống.");
            if (danhMuc && !danhMuc.value.trim()) showFieldError(danhMuc, "Vui lòng chọn danh mục sản phẩm.");
            if (giaBan && !giaBan.value.trim()) showFieldError(giaBan, "Giá bán không được bỏ trống.");
            if (chatLieu && !chatLieu.value.trim()) showFieldError(chatLieu, "Chất liệu không được bỏ trống.");
            
            if (hinhAnhChinh) {
                // Tìm xem ở Ô số 1 (Ảnh đại diện) có cái ảnh cũ nào đang hiển thị không
                const box1 = document.getElementById('box-1');
                const hasOldImage = box1 && box1.querySelector('.preview-zone') && box1.querySelector('.preview-zone').style.display === 'block';

                // Điều kiện chặn lỗi: Ô chọn file mới trống KHÔNG ĐỒNG NGHĨA VỚI VIỆC không có ảnh. 
                // Chỉ báo lỗi khi ô file trống VÀ ảnh cũ cũng không có luôn!
                if (hinhAnhChinh.files.length === 0 && !hasOldImage) {
                    showFieldError(null, "Cần tải lên ít nhất 1 ảnh sản phẩm.", true);
                }
            }

            if (hasError) {
                e.preventDefault(); 
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi thêm sản phẩm',
                        text: 'Vui lòng điền đầy đủ thông tin.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#e74c3c'
                    });
                }
                return false;
            }
        });
    }

    // =========================================================
    // 2. HỨNG LỖI TỪ LARAVEL DỘI VỀ (VÍ DỤ: TRÙNG MÃ SẢN PHẨM)
    // =========================================================
    const errorContainer = document.getElementById('laravel-errors-data');
    if (errorContainer) {
        const errors = JSON.parse(errorContainer.getAttribute('data-errors') || '[]');
        if (errors.length > 0 && typeof Swal !== 'undefined') {
            
            // Tìm xem có lỗi trùng mã trong mảng lỗi gửi về không
            const hasUniqueError = errors.some(error => error.includes('đã tồn tại'));
            
            if (hasUniqueError) {
                const maSP = document.querySelector('input[name="ma_sanpham"]');
                if (maSP) {
                    // Xóa lỗi cũ nếu có trước khi chèn để không bị lặp chữ đỏ
                    const oldErr = maSP.parentNode.querySelector('.inline-error-msg');
                    if (oldErr) oldErr.remove();

                    // Tạo chữ đỏ cảnh báo ngay dưới chân ô mã sản phẩm (Đã thêm text thành công kkk)
                    const errorSpan = document.createElement('span');
                    errorSpan.className = 'inline-error-msg';
                    errorSpan.style.color = '#e74c3c';
                    errorSpan.style.fontSize = '13px';
                    errorSpan.style.marginTop = '5px';
                    errorSpan.style.display = 'block';
                    errorSpan.innerText = "Mã sản phẩm này đã tồn tại trong hệ thống."; // ✨ FIX CHỖ NÀY NHA M
                    maSP.parentNode.appendChild(errorSpan);
                }
            }

            // Đồng bộ tiêu đề thành "Lỗi thêm sản phẩm"
            Swal.fire({ 
                icon: 'error', 
                title: 'Lỗi thêm sản phẩm', 
                text: 'Mã sản phẩm này đã tồn tại trong hệ thống.', 
                confirmButtonText: 'OK', 
                confirmButtonColor: '#e74c3c' 
            });
        }
    }

    // TOAST THÀNH CÔNG
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
    if (!boxItem) return; // Bảo vệ code không bị văng lỗi nếu chạy ở trang khác
    
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

function clearSingleImage(id, maHinhAnh = null) {
    const input = document.getElementById(`file-${id}`);
    const boxItem = document.getElementById(`box-${id}`);
    if (!boxItem) return;

    const placeholder = boxItem.querySelector('.upload-box-placeholder');
    const previewZone = boxItem.querySelector('.preview-zone');

    // 1. Dọn dẹp input file và ẩn vùng preview của ô vừa bấm xóa
    if (input) input.value = ''; 
    if (previewZone) {
        previewZone.innerHTML = '';
        previewZone.style.display = 'none';
    }
    if (placeholder) placeholder.style.display = 'flex';

    // 2. Đẩy Mã Hình Ảnh cũ vào danh sách chờ xóa dưới DB
    if (maHinhAnh) {
        const container = document.getElementById('deleted-images-container');
        if (container) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'deleted_images[]';
            hiddenInput.value = maHinhAnh;
            container.appendChild(hiddenInput);
            console.log(`🎯 Đã thêm mã ảnh ${maHinhAnh} vào hàng chờ xóa.`);
        }
    }

    // 🚀 3. LOGIC TỰ ĐỘNG ĐÔN ẢNH PHỤ LÊN LÀM ẢNH ĐẠI DIỆN VÀ XOÁ LỖI
    // Nếu m vừa xóa ô số 1 (Ảnh Đại Diện)
    if (id === 1) {
        let sourceBox = null;
        let sourceId = 0;

        // Quét tìm xem ô 2 hoặc ô 3, ô nào đang có ảnh để bốc lên
        for (let i = 2; i <= 3; i++) {
            const nextBox = document.getElementById(`box-${i}`);
            const nextPreview = nextBox ? nextBox.querySelector('.preview-zone') : null;
            if (nextPreview && nextPreview.style.display === 'block') {
                sourceBox = nextBox;
                sourceId = i;
                break; // Thấy ảnh ở ô kế tiếp là chốt luôn
            }
        }

        // Nếu tìm thấy một ô phụ đang có ảnh
        if (sourceBox) {
            const sourceImgSrc = sourceBox.querySelector('img').src;
            
            // Tìm lại nút xóa của ô phụ đó để xem nó có mang MaHinhAnh từ DB không
            const sourceBtn = sourceBox.querySelector('.btn-delete-img');
            // Trích xuất chuỗi MaHinhAnh nằm trong thuộc tính onclick của nó
            const onclickText = sourceBtn ? sourceBtn.getAttribute('onclick') : '';
            const match = onclickText.match(/['"]([^'"]+)['"]/g);
            const sourceMaHinhAnh = (match && match[1]) ? match[1].replace(/['"]/g, '') : null;

            // Đôn dữ liệu lên Ô 1 (Ảnh Đại Diện)
            const mainPreviewZone = boxItem.querySelector('.preview-zone');
            const mainPlaceholder = boxItem.querySelector('.upload-box-placeholder');

            mainPreviewZone.innerHTML = `
                <div class="preview-item-box">
                    <img src="${sourceImgSrc}" alt="Ảnh đại diện">
                    <span class="img-badge" style="background: #ff5722;">Ảnh Đại Diện</span>
                    <button type="button" class="btn-delete-img" onclick="clearSingleImage(1, ${sourceMaHinhAnh ? `'${sourceMaHinhAnh}'` : 'null'})">×</button>
                </div>
            `;
            mainPreviewZone.style.display = 'block';
            if (mainPlaceholder) mainPlaceholder.style.display = 'none';

            // Đôn luôn file trong input của ô phụ (nếu có) sang ô 1
            const sourceInput = document.getElementById(`file-${sourceId}`);
            if (sourceInput && sourceInput.files.length > 0) {
                input.files = sourceInput.files;
            }

            // Xóa rỗng ô phụ vừa bốc dữ liệu đi (vì nó đã được chuyển lên ô 1)
            if (sourceInput) sourceInput.value = '';
            const sourcePreview = sourceBox.querySelector('.preview-zone');
            const sourcePlaceholder = sourceBox.querySelector('.upload-box-placeholder');
            if (sourcePreview) {
                sourcePreview.innerHTML = '';
                sourcePreview.style.display = 'none';
            }
            if (sourcePlaceholder) sourcePlaceholder.style.display = 'flex';
            
            console.log(`🚀 Tự động đôn ảnh từ Ô ${sourceId} lên làm Ảnh Đại Diện thành công!`);
        }
    }

    // 🚀 4. TỰ ĐỘNG XOÁ CHỮ BÁO LỖI ĐỎ NẾU GIAO DIỆN VẪN CÒN ẢNH
    let totalActivePreviews = 0;
    for (let i = 1; i <= 3; i++) {
        const box = document.getElementById(`box-${i}`);
        const pZone = box ? box.querySelector('.preview-zone') : null;
        if (pZone && pZone.style.display === 'block') {
            totalActivePreviews++;
        }
    }

    if (totalActivePreviews > 0) {
        document.querySelectorAll('.inline-error-msg').forEach(el => {
            if (el.innerText.includes("ít nhất 1 ảnh sản phẩm")) {
                el.remove();
            }
        });
    }
}