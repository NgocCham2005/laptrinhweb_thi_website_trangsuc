{{-- ========================= --}}
{{-- ĐƠN HÀNG --}}
{{-- ========================= --}}

<div id="orders" class="tab-content {{ $tab == 'orders' ? 'active' : '' }}">
    <form method="GET" class="report-filter">

        <div class="filter-header">

            <h2 class="section-title">Bộ lọc dữ liệu</h2>

            <div class="filter-actions">

                <a href="{{ route('admin.reports.index') }}">
                    <x-button type="button">Đặt lại</x-button>
                </a>

                <x-button type="submit">Lọc dữ liệu</x-button>

            </div>

        </div>

        <div class="filter-grid">

            <input type="hidden" name="tab" value="orders">

            <div>
                <label>Từ ngày</label>
                <input type="date" name="from" value="{{ $from }}">
            </div>

            <div>
                <label>Đến ngày</label>
                <input type="date" name="to" value="{{ $to }}">
            </div>

            <div>

                <label>Trạng thái</label>

                <select name="status">
                    <option value="">Tất cả</option>

                    <option value="0" {{ $status === '0' ? 'selected' : '' }}>
                        Chờ xác nhận
                    </option>

                    <option value="1" {{ $status === '1' ? 'selected' : '' }}>
                        Đã xác nhận
                    </option>

                    <option value="2" {{ $status === '2' ? 'selected' : '' }}>
                        Đang giao
                    </option>

                    <option value="3" {{ $status === '3' ? 'selected' : '' }}>
                        Thành công
                    </option>

                    <option value="4" {{ $status === '4' ? 'selected' : '' }}>
                        Không thành công
                    </option>
                </select>

            </div>

            <div>

                <label>Kiểu thống kê</label>

                <select name="type">
                    <option value="day" {{ $type === 'day' ? 'selected' : '' }}>Theo ngày</option>
                    <option value="month" {{ $type === 'month' ? 'selected' : '' }}>Theo tháng</option>
                    <option value="year" {{ $type === 'year' ? 'selected' : '' }}>Theo năm</option>
                </select>

            </div>

        </div>

    </form>

    <h2 class="section-title">Tổng quan đơn hàng</h2>

    <div class="dashboard-grid">

        <div class="dashboard-card">
            <div class="card-title">Tổng đơn hàng</div>
            <div class="card-value">{{ $totalOrders }}</div>
        </div>

        <div class="dashboard-card">
            <div class="card-title">Đơn đang giao</div>
            <div class="card-value">{{ $shippingOrders }}</div>
        </div>
        <div class="dashboard-card">
            <div class="card-title">Đơn thành công</div>
            <div class="card-value">{{ $completedOrders }}</div>
        </div>
        <div class="dashboard-card">
            <div class="card-title">Đơn không thành công</div>
            <div class="card-value">{{ $failedOrders }}</div>
        </div>
        <div class="dashboard-card">
            <div class="card-title">Tỷ lệ hoàn thành</div>
            <div class="card-value">{{ $completionRate }}%</div>
        </div>

    </div>

    <h2 class="section-title">Biểu đồ phân tích</h2>

    <div class="chart-grid">

        <div class="chart-card">
            <h3>Đơn hàng theo thời gian</h3>
            <canvas id="orderChart"></canvas>
        </div>

        <div class="chart-card">
            <h3>Trạng thái đơn hàng</h3>
            <canvas id="statusChart"></canvas>
        </div>

    </div>

    <h2 class="section-title">Bảng dữ liệu chi tiết</h2>

    <div class="analytics-card">

        <h3>Trạng thái đơn hàng</h3>

        <x-table>

            <tr>
                <th>Trạng thái</th>
                <th>Số lượng</th>
                <th>Tỷ lệ</th>
            </tr>

            @foreach($orderStatusStats as $s)
                <tr>
                    <td>
                    @switch($s->TrangThai)

                        @case(0)
                            Chờ xác nhận
                            @break

                        @case(1)
                            Đã xác nhận
                            @break

                        @case(2)
                            Đang giao
                            @break

                        @case(3)
                            Thành công
                            @break

                        @case(4)
                            Không thành công
                            @break

                        @default
                            Không xác định

                    @endswitch
                    </td>
                    <td>{{ $s->tong }}</td>
                    <td>
                        {{ $totalOrders > 0 ? round(($s->tong / $totalOrders) * 100, 2) : 0 }}%
                    </td>
                </tr>
            @endforeach

        </x-table>

    </div>

    <div class="analytics-card">

        <h3>Trạng thái đơn hàng theo thời gian</h3>

        <x-table>

            <tr>
                <th>Thời gian</th>
                <th>Tổng đơn</th>
                <th>Chờ xác nhận</th>
                <th>Đã xác nhận</th>
                <th>Đang giao</th>
                <th>Thành công</th>
                <th>Không thành công</th>
            </tr>

            @forelse($orderReports as $r)

                <tr>
                    <td>{{ $r->ngay }}</td>
                    <td>{{ $r->so_don }}</td>
                    <td>{{ $r->cho_xac_nhan }}</td>
                    <td>{{ $r->da_xac_nhan }}</td>
                    <td>{{ $r->dang_giao }}</td>
                    <td>{{ $r->thanh_cong }}</td>
                    <td>{{ $r->khong_thanh_cong }}</td>
                </tr>

            @empty

                <tr>
                    <td colspan="7">Không có dữ liệu</td>
                </tr>

            @endforelse

        </x-table>

    </div>

</div>