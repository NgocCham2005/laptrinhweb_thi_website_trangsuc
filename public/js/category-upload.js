document.addEventListener('DOMContentLoaded', function () {
    console.log("🚀 JS Giao diện Preview ảnh Danh mục đã kích hoạt!");

    const fileInput = document.getElementById('file-cat-1');
    const placeholder = document.getElementById('placeholder-cat-1');
    const previewZone = document.getElementById('preview-cat-1');

    // 1. Hàm dùng chung để xóa ảnh preview trên giao diện
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

    // 2. Lắng nghe chọn file ảnh mới để tạo preview trực quan
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

                    // Gắn sự kiện xóa cho ảnh mới vừa chọn
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
});