@extends('backend.master')
@section('content')
<div class="container">
    <div class="row">
        <div id="main-content">
            <canvas id="orders-chart"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Payable</h4>
                    <p class="text-primary">{{ payableDue() }} BDT.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Sold</h4>
                    <p class="text-primary">{{ totalSold() }} Items</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Owned</h4>
                    <p class="text-primary">{{ ownedItems() }} Items</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var ctx = document.getElementById('orders-chart').getContext('2d');

var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($monthsToChartJs) !!},
        datasets: [{
            label: 'Orders',
            data: {!! json_encode($ordersToChartJs) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 3,
            // borderColor: Utils.CHART_COLORS.red,
            fill: false,
            cubicInterpolationMode: 'monotone',
            tension: 0.4
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        plugins: {
            filler: {
                propagate: false
            }
        },
        cubicInterpolationMode: 'monotone',
        tension: 0.4
    }
});
</script>
@endsection