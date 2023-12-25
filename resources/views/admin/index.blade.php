@extends('admin.layouts.master')
@section('title', $title)
@section('page_css')
<style>
    #pieChart{
        max-width: 100% !important;
        max-height: 500px !important;
    }
</style>
@endsection

@section('content')

<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ bitcoin-wallet section ] start-->
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <div class="card-block">
                        <h5 class="text-white mb-2">عدد الطلبات</h5>
                        <h2 class="text-white mb-2 f-w-300"> {{ $orders }}</h2>
                        <i class="fa-solid fa-cart-plus f-70 text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <div class="card-block">
                        <h5 class="text-white mb-2"> إجمالى الطلبات</h5>
                        <h2 class="text-white mb-2 f-w-300"> {{ $total_orders }}</h2>
                        <i class="fa-solid fa-money-check-dollar f-70 text-white"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="card bg-c-blue bitcoin-wallet">
                    <div class="card-block">
                        <h5 class="text-white mb-2">باقى الطلبات</h5>
                        <h2 class="text-white mb-2 f-w-300"> {{ $total_remaining }}</h2>
                        <i class="fa-solid fa-money-check-dollar f-70 text-white"></i>
                    </div>
                </div>
            </div>
          
            <!-- [ bitcoin-wallet section ] end-->
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="card theme-bg bitcoin-wallet">
                    <div class="card-block">
                    <h5 class="text-white mb-2">عدد العملاء</h5>
                        <h2 class="text-white mb-2 f-w-300"> {{ $clients  }}</h2>
                        <i class="fas fa-user-check f-70 text-white"></i>
                    </div>
                </div>
            </div>
          
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="card theme-bg bitcoin-wallet">
                    <div class="card-block">
                        <h5 class="text-white mb-2">مندوبى التوصيل</h5>
                        <h2 class="text-white mb-2 f-w-300"> {{ $delivery }}</h2>
                        <i class="fas fa-user-tag f-70 text-white"></i>
                    </div>
                </div>
            </div>
           
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="card theme-bg bitcoin-wallet">
                    <div class="card-block">
                        <h5 class="text-white mb-2">مندوبى المبيعات</h5>
                        <h2 class="text-white mb-2 f-w-300"> {{ $sales }}</h2>
                        <i class="fas fa-user-tag f-70 text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <canvas id="lineChart" height="100px"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-xl-6 mt-5">
                <canvas id="myChart" height="220px"></canvas>
            </div>
            <div class="col-12 col-md-6 col-xl-6 mt-5">
                <canvas id="MostRequiredproductInYear" height="220px"></canvas>
            </div>
        </div>

        <div class="row">
        <div class="col-12 col-md-6 col-xl-6 mt-5">
                <canvas id="mostOrderedClient" height="220px"></canvas>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div

@endsection
@section('page_js')
<script src="{{ asset('dashboard/plugins/chart-chartjs/js/chart.min.js') }}"></script>


<script type="text/javascript">
      "use strict";
      const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($productIds); ?>,
        datasets: [{
            label: 'Most Required Products',
            data: <?php echo json_encode($productCounts); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'المنتجات الاكثر طلبا خلال الشهر (<?php echo $currentMonth . "/" . $currentYear; ?>)'
            }
        }
    },
});

const MostRequiredproductInYearChart = document.getElementById('MostRequiredproductInYear').getContext('2d');
const MostRequiredproductInYearChartoj = new Chart(MostRequiredproductInYearChart, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($productIdsinyear); ?>,
        datasets: [{
            label: 'Most Required Products in Current Year',
            data: <?php echo json_encode($productCountsinyear); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'المنتجات الاكثر طلبا خلال العام (<?php echo  $currentYear; ?>)'
            }
        }
    },
});



const mostOrderedClient = document.getElementById('mostOrderedClient').getContext('2d');
const mostOrderedClientobj = new Chart(mostOrderedClient, {
    type: 'bar',
    data: {
        labels: <?php echo $orders->pluck('client.name') ?>,
        datasets: [{
            label: 'Most Required Products in Current Year',
            data: <?php echo $orders->pluck('total') ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'المنتجات الاكثر طلبا خلال العام (<?php echo  $currentYear; ?>)'
            }
        }
    },
});
</script>
@endsection
