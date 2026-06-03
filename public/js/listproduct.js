// public/js/product-filter.js
document.addEventListener("DOMContentLoaded", function() {
    // 1. Lấy cái Route URL từ thuộc tính action của Form để làm gốc chuyển trang
    const filterForm = document.getElementById('filterForm');
    if (!filterForm) return; // Nếu trang nào không có form lọc thì nghỉ khỏe
    
    const baseUrl = filterForm.getAttribute('action');

    // Hàm gom toàn bộ parameter sạch để tự chuyển trang bằng URL
    function executeFilter() {
        const danhMuc = document.getElementById('filter_danh_muc').value;
        const gia = document.getElementById('filter_gia').value;
        const chatLieu = document.getElementById('filter_chat_lieu').value;
        const sort = document.getElementById('filter_sort').value;
        const searchInput = document.getElementById('filter_search');
        const search = searchInput ? searchInput.value : '';

        // Tạo đối tượng URLSearchParams để tự build chuỗi query string
        let params = new URLSearchParams();
        
        if (danhMuc && danhMuc !== 'all') params.append('danh_muc', danhMuc);
        if (search) params.append('search', search);
        if (gia) params.append('gia', gia);
        if (chatLieu && chatLieu !== 'all') params.append('chat_lieu', chatLieu);
        if (sort) params.append('sort', sort);

        // Chuyển hướng trực tiếp bằng trình duyệt, đập tan hiện tượng đơ cache form
        window.location.href = baseUrl + (params.toString() ? "?" + params.toString() : "");
    }

    // 2. Lắng nghe sự kiện click trên các Danh mục ở Sidebar
    document.querySelectorAll('.category-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('filter_danh_muc').value = this.getAttribute('data-id');
            executeFilter();
        });
    });

    // 3. Lắng nghe sự kiện thay đổi trên cả 3 ô Select bộ lọc
    const filterGia = document.getElementById('filter_gia');
    const filterChatLieu = document.getElementById('filter_chat_lieu');
    const filterSort = document.getElementById('filter_sort');

    if (filterGia) filterGia.addEventListener('change', executeFilter);
    if (filterChatLieu) filterChatLieu.addEventListener('change', executeFilter);
    if (filterSort) filterSort.addEventListener('change', executeFilter);
});