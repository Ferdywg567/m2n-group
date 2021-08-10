@extends('backend.master')

@section('title', 'Dashboard')

@section('dashboard', 'class=active')
@if (auth()->user()->hasRole('production'))
@section('content')
<section class="section">

    <div class="row">
        <div class="col-md-12 text-right">
            <div class="row">
                <div class="col-md-9">

                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" id="bulan">
                                    @forelse ($month as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" id="tahun">
                                    @forelse ($tahun as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="card card-statistic-1" style="height: 14.5rem">

                <div class="row">
                    <div class="col-md-12 ml-3">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-tshirt"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <h4>Jumlah Kain</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-px-0 ml-3">
                                    <h1 id="jumlah_kain"> 59</h1>
                                </div>
                                <div class="col-md-6  mt-2">
                                    <h3>yard</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jenis Bahan</h4>
                            </div>
                            <div class="card-body">

                                <h2 id="jenis_bahan">
                                    10
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Berhasil Cuci</h4>
                            </div>
                            <div class="card-body">
                                <h2 id="berhasil_cuci">
                                    10
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Hasil Potong</h4>
                            </div>
                            <div class="card-body">
                                <h2 id="hasil_potong">10</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Siap Quality Control</h4>
                            </div>
                            <div class="card-body">
                                <h2 id="siap_qc"> 10</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Berhasil Jahit</h4>
                            </div>
                            <div class="card-body">
                                <h2 id="berhasil_jahit"> 10</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Baju Rusak / Buang</h4>
                            </div>
                            <div class="card-body">
                                <h2 id="baju_rusak">10</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Preview Cutting</h4>
                    <div class="card-header-action">
                        <a href="{{route('potong.index')}}" class="btn btn-danger">View More <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="table-cutting">
                            <thead>
                                <tr>
                                    <th>Kode Bahan</th>
                                    <th>SKU</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><a href="#">INV-87239</a></td>
                                    <td class="font-weight-600">Kusnadi</td>
                                    <td>
                                        <div class="badge badge-warning">Unpaid</div>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Preview Tailoring</h4>
                    <div class="card-header-action">
                        <a href="{{route('jahit.index')}}" class="btn btn-danger">View More <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="table-jahit">
                            <thead>
                                <tr>
                                    <th>Kode Bahan</th>
                                    <th>SKU</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><a href="#">INV-87239</a></td>
                                    <td class="font-weight-600">Kusnadi</td>
                                    <td>
                                        <div class="badge badge-warning">Unpaid</div>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Preview Washing</h4>
                    <div class="card-header-action">
                        <a href="{{route('cuci.index')}}" class="btn btn-danger">View More <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="table-cuci">
                            <thead>
                                <tr>
                                    <th>Kode Bahan</th>
                                    <th>SKU</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><a href="#">INV-87239</a></td>
                                    <td class="font-weight-600">Kusnadi</td>
                                    <td>
                                        <div class="badge badge-warning">Unpaid</div>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="barChart" width="400" height="300"></canvas>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="pieChart" width="400" height="300"></canvas>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="lineChart" width="400" height="300"></canvas>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{asset('assets/modules/chart.min.js')}}"></script>
<script>
    $(document).ready(function () {
        var pieChart;
        var barChart;
        var lineChart;
       var table_cutting = $('#table-cutting').DataTable({
            "searching": false,
            "info": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
             data:[],
                columns: [
                { "data": "bahan.kode_bahan"  },
                { "data": "bahan.sku" },
                { "data": "status_potong" }
            ],
            "rowCallback":function(row, data, index){

                var datahtml = "";
                if(data.status_potong == 'belum potong'){
                    datahtml = '<span class="badge badge-secondary text-dark">'+data.status_potong+'</span>';
                }else if(data.status_potong == 'selesai'){
                    datahtml = '<span class="badge badge-success text-dark">'+data.status_potong+'</span>';
                }else {
                    datahtml = '<span class="badge badge-warning text-dark">'+data.status_potong+'</span>';
                }

                $('td:eq(2)',row).html(datahtml)
            }
        })

     var table_jahit =   $('#table-jahit').DataTable({
            "searching": false,
            "info": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            data:[],
                columns: [
                { "data": "potong.bahan.kode_bahan"  },
                { "data": "potong.bahan.sku" },
                { "data": "status_jahit" }
            ],
            "rowCallback":function(row, data, index){

                var datahtml = "";
                if(data.status_jahit == 'belum jahit'){
                    datahtml = '<span class="badge badge-secondary text-dark">'+data.status_jahit+'</span>';
                }else if(data.status_jahit == 'selesai'){
                    datahtml = '<span class="badge badge-success text-dark">'+data.status_jahit+'</span>';
                }else {
                    datahtml = '<span class="badge badge-warning text-dark">'+data.status_jahit+'</span>';
                }

                $('td:eq(2)',row).html(datahtml)
            }
        })

     var table_cuci =   $('#table-cuci').DataTable({
            "searching": false,
            "info": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            data:[],
                columns: [
                { "data": "jahit.potong.bahan.kode_bahan"  },
                { "data": "jahit.potong.bahan.sku" },
                { "data": "status_cuci" }
            ],
            "rowCallback":function(row, data, index){

                var datahtml = "";
                if(data.status_cuci == 'belum cuci'){
                    datahtml = '<span class="badge badge-secondary text-dark">'+data.status_cuci+'</span>';
                }else if(data.status_cuci == 'selesai'){
                    datahtml = '<span class="badge badge-success text-dark">'+data.status_cuci+'</span>';
                }else {
                    datahtml = '<span class="badge badge-warning text-dark">'+data.status_cuci+'</span>';
                }

                $('td:eq(2)',row).html(datahtml)
            }
        })



        function barChartData() {
            var ctx = document.getElementById('barChart').getContext('2d');
         barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: 'Jumlah Kain',
                    data: [12, 19, 3, 5, 2, 3],
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

        function pieChartData()
        {
            var ctx = document.getElementById("pieChart").getContext('2d');
             pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Green", "Blue", "Gray", "Purple", "Yellow", "Red", "Black"],
                datasets: [{
                backgroundColor: [
                    "#2ecc71",
                    "#3498db",
                    "#95a5a6",
                    "#9b59b6",
                    "#f1c40f",
                    "#e74c3c",
                    "#34495e"
                ],
                data: [12, 19, 3, 17, 28, 24, 7]
                }]
            }
            });
        }


        function lineChartData() {
            var ctx = document.getElementById('lineChart').getContext('2d');
         lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: 'Jumlah Kain',
                    data: [12, 19, 3, 5, 2, 3],
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

        $('#bulan, #tahun').on('change', function () {
            var bulan = $('#bulan').find(':selected').val()
            var tahun = $('#tahun').find(':selected').val()
            table_cutting.clear().draw;
            table_jahit.clear().draw;
            table_cuci.clear().draw;
            $.ajax({
                url:"{{route('dashboard.index')}}",
                method:"GET",
                data:{
                    'bulan':bulan,
                    'tahun':tahun
                },success:function(data){
                    // console.log(data);
                    if(data.status){

                        if (typeof(pieChart) != "undefined") {
                             pieChart.destroy();
                        }
                        if (typeof(barChart) != "undefined") {
                             barChart.destroy();
                        }
                        if (typeof(lineChart) != "undefined") {
                             lineChart.destroy();
                        }
                        pieChartData()
                        barChartData()
                        lineChartData()
                        table_cutting.rows.add(data.potong).draw();
                        table_jahit.rows.add(data.jahit).draw();
                        table_cuci.rows.add(data.cuci).draw();
                        $('#jumlah_kain').text(data.jumlah_kain)
                        $('#jenis_bahan').text(data.jenis_bahan)
                        $('#berhasil_cuci').text(data.berhasil_cuci)
                        $('#siap_qc').text(data.berhasil_cuci)
                        $('#hasil_potong').text(data.hasil_cutting)
                        $('#berhasil_jahit').text(data.berhasil_jahit)
                        $('#baju_rusak').text(data.baju_rusak)
                    }
                }
            })
         })
     })
</script>
@endpush
@endif
