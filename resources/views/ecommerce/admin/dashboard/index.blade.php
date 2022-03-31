@extends('ecommerce.admin.master')
@section('title', 'Beranda')
@section('title-nav', 'Beranda')
@section('dashboard', 'class=active-sidebar')
@section('content')
    <section class="section mt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Pendapatan Online</h4>
                        <canvas id="pendapatanOnline" width="400" height="300"></canvas>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Pendapatan Offline</h4>
                        <canvas id="pendapatanOffline" width="400" height="300"></canvas>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Total Pendapatan</h4>
                        <canvas id="totalPendapatan" width="400" height="300"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var pieChart;
            var barChart;
            var lineChart;

            function generateColour() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            }
            var randomColorGenerator = function() {
                return '#' + (Math.random().toString(16) + '0000000').slice(2, 8);
            };

            function barChartData(data, label, nama, color) {
                var ctx = document.getElementById(nama).getContext('2d');
                barChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'Pendapatan',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }


            $.ajax({
                url: "{{ route('ecommerce.dashboard.index') }}",
                method: "GET",
                success: function(data) {
                    if (data.status) {
                        var offline = data.offline
                        var tanggal_offline = []
                        var total_offline = []
                        var color_offline = []
                        offline.forEach(element => {
                            tanggal_offline.push(element.tanggal)
                            total_offline.push(element.total)
                            color_offline.push(randomColorGenerator())
                        });


                        barChartData(total_offline, tanggal_offline, 'pendapatanOffline', color_offline)

                        var online = data.online
                        var tanggal_online = []
                        var total_online = []
                        var color_online = []
                        online.forEach(element => {
                            tanggal_online.push(element.tanggal)
                            total_online.push(element.total)
                            color_online.push(randomColorGenerator())
                        });

                        setTimeout(() => {
                            barChartData(total_online, tanggal_online, 'pendapatanOnline',
                                color_online)
                        }, 1000);


                        var semua = data.semua
                        var tanggal_semua = []
                        var total_semua = []
                        var color_semua = []
                        semua.forEach(element => {
                            tanggal_semua.push(element.tanggal)
                            total_semua.push(element.total)
                            color_semua.push(randomColorGenerator())
                        });
                        setTimeout(() => {
                            barChartData(total_semua, tanggal_semua, 'totalPendapatan',
                                color_semua)
                        }, 1500);
                    }
                }
            })

        })
    </script>
@endpush
