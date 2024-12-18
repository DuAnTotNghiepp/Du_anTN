@extends('admin.layouts.master')

@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tỷ lệ hoàn thành & Hủy đơn hàng</h4>
                </div>
                <div class="card-body">
                    <canvas id="completionChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tổng số đơn hàng và tỷ lệ hoàn thành & hủy</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="mb-1">Đơn hoàn thành: <strong>{{ $completedOrders }}</strong></h5>
                        <h5 class="mb-1">Tỷ lệ hoàn thành: <strong>{{ number_format($completionRate, 2) }}</strong>%</h5>
                        <h5 class="mb-1">Đơn hủy: <strong>{{ $canceledOrders }}</strong></h5>
                        <h5 class="mb-1">Tỷ lệ hủy: <strong>{{ number_format($cancellationRate, 2) }}</strong>%</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            var ctx = document.getElementById('completionChart').getContext('2d');
            var completionChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Hoàn thành', 'Hủy'],
                    datasets: [{
                        data: [{{ $completedOrders }}, {{ $canceledOrders }}],
                        backgroundColor: ['#4CAF50', '#FF5733'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    var value = tooltipItem.raw;
                                    return value.toLocaleString(); 
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
