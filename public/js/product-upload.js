document.addEventListener('DOMContentLoaded', function () {
    // Vòng lặp cài đặt sự kiện cho cả 3 ô input file
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
            // Hiển thị ảnh xem trước và nút xóa hình
            previewZone.innerHTML = `
                <div class="preview-item-box">
                    <img src="${e.target.result}" alt="Preview">
                    <span class="img-badge">${id === 1 ? 'Ảnh Chính' : 'Ảnh Phụ'}</span>
                    <button type="button" class="btn-delete-img" onclick="clearSingleImage(${id})">×</button>
                </div>
            `;
            previewZone.style.display = 'block';
            placeholder.style.display = 'none'; // Ẩn dấu cộng của ô hiện tại đi

            // 🚀 KÍCH HOẠT Ô TIẾP THEO: Nếu vừa up ô 1 thì hiện ô 2, vừa up ô 2 thì hiện ô 3
            if (id < 3) {
                const nextBox = document.getElementById(`box-${id + 1}`);
                if (nextBox) nextBox.style.display = 'block';
            }
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function clearSingleImage(id) {
    const input = document.getElementById(`file-${id}`);
    const boxItem = document.getElementById(`box-${id}`);
    const placeholder = boxItem.querySelector('.upload-box-placeholder');
    const previewZone = boxItem.querySelector('.preview-zone');

    input.value = ''; // Reset file trong input về rỗng
    previewZone.innerHTML = '';
    previewZone.style.display = 'none';
    placeholder.style.display = 'flex'; // Hiện lại dấu cộng

    // Nếu xóa ảnh chính (ô 1) hoặc ảnh giữa, ta ẩn luôn các ô phía sau đi cho chuẩn logic
    if (id === 1) {
        document.getElementById('box-2').style.display = 'none';
        clearSingleImage(2);
    }
    if (id === 2) {
        document.getElementById('box-3').style.display = 'none';
        clearSingleImage(3);
    }
}