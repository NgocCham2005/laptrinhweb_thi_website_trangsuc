<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    function showTab(event, tabId)
    {
        document.querySelectorAll('.tab-content')
            .forEach(tab => tab.classList.remove('active'));

        document.querySelectorAll('.tab-btn')
            .forEach(btn => btn.classList.remove('active'));

        document.getElementById(tabId)
            .classList.add('active');

        event.currentTarget.classList.add('active');
    }

    new Chart(
        document.getElementById('revenueChart'),
        {
            type: 'bar',

            data: {

                labels: @json(
                    $revenueReports->pluck('ngay')
                ),

                datasets: [{

                    label: 'Doanh thu',

                    data: @json(
                        $revenueReports->pluck('doanh_thu')
                    ),

                    borderWidth: 1

                }]
            }
        }
    );

    new Chart(
        document.getElementById('orderChart'),
        {
            type: 'line',

            data: {

                labels: @json(
                    $orderReports->pluck('ngay')
                ),

                datasets: [{

                    label: 'Đơn hàng',

                    data: @json(
                        $orderReports->pluck('so_don')
                    ),

                    borderWidth: 2

                }]
            }
        }
    );
    new Chart(
        document.getElementById('topProductChart'),
        {
            type: 'pie',

            data: {

                labels: @json(
                    $topProducts->pluck('TenSanPham')
                ),

                datasets: [{
                    data: @json(
                        $topProducts->pluck('doanh_thu')
                    )
                }]
            }
        }
    );

    new Chart(
        document.getElementById('statusChart'),
        {
            type: 'doughnut',

            data: {

                labels: [

                    'Chờ xác nhận',
                    'Đã xác nhận',
                    'Đang giao',
                    'Hoàn thành'

                ],

                datasets: [{
                    data: @json(
                        $orderStatusStats->pluck('tong')
                    )
                }]
            }
        }
    );
    const categoryFilter =
        document.getElementById('categoryFilter');

    const productFilter =
        document.getElementById('productFilter');

    if(categoryFilter && productFilter){

        categoryFilter.addEventListener(
            'change',
            function(){

                const category =
                    this.value;

                productFilter.value = '';

                Array.from(
                    productFilter.options
                ).forEach(option => {

                    if(option.value === ''){
                        option.hidden = false;
                        return;
                    }

                    if(
                        category === '' ||
                        option.dataset.category === category
                    ){
                        option.hidden = false;
                    }
                    else{
                        option.hidden = true;
                    }

                });

            }
        );

        categoryFilter.dispatchEvent(
            new Event('change')
        );
    }

</script>
