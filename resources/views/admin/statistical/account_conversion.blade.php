@extends('admin.layouts.master')

@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tỷ lệ chuyển đổi tài khoản</h4>
                </div>
                <div class="card-body">
                    <canvas id="conversionChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tổng số tài khoản và tỷ lệ chuyển đổi</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="mb-1">Tổng số tài khoản: <strong>{{ $totalUsers }}</strong></h5>
                        <h5 class="mb-1">Tài khoản đã chuyển đổi: <strong>{{ $convertedUsers }}</strong></h5>
                        <h5 class="mb-1">Tỷ lệ chuyển đổi: <strong>{{ number_format($conversionRate, 2) }}</strong>%</h5>
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
            var ctx = document.getElementById('conversionChart').getContext('2d');
            var conversionChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Đã chuyển đổi', 'Chưa chuyển đổi'],
                    datasets: [{
                        data: [{{ $convertedUsers }}, {{ $totalUsers - $convertedUsers }}],
                        backgroundColor: ['#36a2eb', '#ff6384'],
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
