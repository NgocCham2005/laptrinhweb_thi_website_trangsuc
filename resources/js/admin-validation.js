document.addEventListener('DOMContentLoaded', function () {
    // 1. Kiểm tra xem thẻ HTML có chứa dữ liệu lỗi từ Laravel gửi về không
    const errorContainer = document.getElementById('laravel-errors-data');
    if (errorContainer) {
        // Lấy chuỗi JSON lỗi ra và giải mã (parse)
        const errors = JSON.parse(errorContainer.getAttribute('data-errors') || '[]');
        
        if (errors.length > 0) {
            let errorMessages = '';
            errors.forEach(error => {
                errorMessages += `• ${error}\n`;
            });

            // Bắn Popup báo lỗi đỏ rực bằng SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Thiếu thông tin!',
                text: errorMessages,
                confirmButtonText: 'Nhập lại',
                confirmButtonColor: '#e74c3c'
            });
        }
    }

    const successContainer = document.getElementById('laravel-success-data');
    if (successContainer) {
        const successMessage = successContainer.getAttribute('data-message');
        if (successMessage) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            Toast.fire({
                icon: 'success',
                title: successMessage
            });
        }
    }
});