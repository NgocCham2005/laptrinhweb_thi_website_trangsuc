{{-- ========================= --}}
{{-- DOANH THU --}}
{{-- ========================= --}}

<div id="revenue" class="tab-content {{ $tab == 'revenue' ? 'active' : '' }}">
    <form method="GET" class="report-filter">
        <div class="filter-header">
            <h2 class="section-title">
                Bộ lọc dữ liệu
            </h2>

            <div class="filter-actions">
                <a href="{{ route('admin.reports.index') }}">
                    <x-button type="button">
                        Đặt lại
                    </x-button>
                </a>

                <x-button type="submit">
                    Lọc dữ liệu
                </x-button>
            </div>
        </div>

        <div class="filter-grid">
            <input type="hidden" name="tab" value="revenue">

            <div>
                <label>Từ ngày</label>
                <input type="date" name="from" value="{{ $from }}">
            </div>

            <div>
                <label>Đến ngày</label>
                <input type="date" name="to" value="{{ $to }}">
            </div>

            <div>
                <label>Danh mục</label>
                <select name="category" id="categoryFilter">
                    <option value="">Tất cả</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->MaDanhMuc }}" @selected($category == $c->MaDanhMuc)>
                            {{ $c->TenDanhMuc }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Sản phẩm</label>
                <select name="product" id="productFilter">
                    <option value="">Tất cả</option>
                    @foreach($products as $p)
                        <option value="{{ $p->MaSanPham }}" data-category="{{ $p->MaDanhMuc }}"
                            @selected($product == $p->MaSanPham)>
                            {{ $p->TenSanPham }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <h2 class="section-title">Tổng quan doanh thu</h2>

    <div class="dashboard-grid">
        <div class="dashboard-card">
            <div class="card-title">Tổng doanh thu</div>
            <div class="card-value">{{ number_format($totalRevenue) }}đ</div>
        </div>

        <div class="dashboard-card">
            <div class="card-title">Doanh thu trung bình</div>
            <div class="card-value">{{ number_format($averageRevenue) }}đ</div>
        </div>

        <div class="dashboard-card">
            <div class="card-title">Số đơn tạo doanh thu</div>
            <div class="card-value">{{ $totalRevenueOrders }}</div>
        </div>

        <div class="dashboard-card">
            <div class="card-title">Giá trị đơn TB</div>
            <div class="card-value">{{ number_format($averageOrderValue) }}đ</div>
        </div>
    </div>

    <h2 class="section-title">Biểu đồ phân tích</h2>

    <div class="chart-grid">
        <div class="chart-card">
            <h3>Doanh thu theo thời gian</h3>
            <canvas id="revenueChart"></canvas>
        </div>

        <div class="chart-card">
            <h3>Top sản phẩm</h3>
            <canvas id="topProductChart"></canvas>
        </div>
    </div>

    <h2 class="section-title">Bảng dữ liệu chi tiết</h2>

    <div class="analytics-card">
        <h3>Top sản phẩm bán chạy</h3>

        <x-table>
            <tr>
                <th>Sản phẩm</th>
                <th>Danh mục</th>
                <th>Đã bán</th>
                <th>Doanh thu</th>
                <th>Tỷ trọng</th>
            </tr>

            @foreach($topProducts as $p)
                <tr>
                    <td>{{ $p->TenSanPham }}</td>
                    <td>{{ $p->TenDanhMuc }}</td>
                    <td>{{ $p->tong_ban }}</td>
                    <td>{{ number_format($p->doanh_thu) }}đ</td>
                    <td>
                        {{ $totalRevenue > 0
                            ? round(($p->doanh_thu / $totalRevenue) * 100, 2)
                            : 0
                        }}%
                    </td>
                </tr>
            @endforeach
        </x-table>
    </div>

    <div class="analytics-card">
        <h3>Doanh thu theo ngày</h3>

        <x-table>
            <tr>
                <th>Ngày</th>
                <th>Số đơn</th>
                <th>Doanh thu</th>
                <th>TB/đơn</th>
            </tr>

            @forelse($revenueReports as $r)
                <tr>
                    <td>{{ $r->ngay }}</td>
                    <td>{{ $r->so_don }}</td>
                    <td>{{ number_format($r->doanh_thu) }}đ</td>
                    <td>
                        {{ number_format($r->so_don > 0 ? $r->doanh_thu / $r->so_don : 0) }}đ
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Không có dữ liệu</td>
                </tr>
            @endforelse
        </x-table>
    </div>

</div>