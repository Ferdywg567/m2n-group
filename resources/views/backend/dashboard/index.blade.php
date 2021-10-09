@extends('backend.master')

@section('title', 'Beranda')
@section('title-nav', 'Beranda')

@section('dashboard', 'class=active-sidebar')

{{-- production --}}
@if (auth()->user()->hasRole('production'))
@section('content')
<style>
    .gray {
        color: #AEAEB2;
        font-size: 14px;
    }

    .selectgrey {
        background-color: #E5E5EA;
    }


    .size10 {
        font-size: 11px !important;
    }

    .size12 {
        font-size: 11px !important;
        color: #AEAEB2;
    }

    .size15 {
        font-size: 15px !important;
        color: #AEAEB2;
    }

    th {
        font-size: 10px;
        text-align: center;
    }

    td {
        text-align: center;
        font-size: 10px;
    }


    .label-data {
        font-size: 16px !important;
    }

    .badge {
        font-size: 10px;
    }
</style>
<section class="section mt-3">

    <div class="row">
        <div class="col-md-12 text-right">
            <div class="row">
                <div class="col-md-9">

                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control selectgrey" id="bulan">
                                    @forelse ($month as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control selectgrey" id="tahun">
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
                        <div class="card-icon " style="background-color: rgba(26, 205, 255, 0.30);
                        border-radius: 8px;">
                            <img src="{{asset('assets/icon/t-shirt-fill-biru.png')}}" alt="" srcset="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <h4 class="size10">Jumlah Kain</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-px-0 ml-3">
                                    <h3 id="jumlah_kain"> 0</h3>
                                </div>
                                <div class="col-md-6 ">
                                    <h3 style="color: #AEAEB2;">yard</h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h6 class="size10" style="color:#34C759" id="labelarrow"><i
                                            class="ri-arrow-right-up-line"></i> Lebih banyak 12 yard dari bulan lalu
                                    </h6>
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
                    <div class="card card-statistic-1" style="height:100px;">

                        <div class="card-icon mt-2" style="background-color: rgba(176, 84, 222, 0.30);
                            border-radius: 8px;">
                            <img src="{{asset('assets/icon/shirt-fill-purple.png')}}" alt="" srcset="">
                        </div>


                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 class="size10" style="margin-top: -6px !important">Jenis Bahan</h4>
                            </div>
                            <div class="card-body">
                                <span id="jenis_bahan" class="label-data">
                                    0
                                </span>
                                <div style="margin-top: -10px !important">
                                    <span class="size15">Jenis</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon" style="background-color: rgba(92, 200, 250, 0.3);
                        border-radius: 8px;">
                            <img src="{{asset('assets/icon/hand-coin-fill-biru.png')}}" alt="" srcset="">
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 class="size10" style="margin-top: -6px !important">Berhasil Cuci</h4>
                            </div>
                            <div class="card-body">
                                <h4 id="berhasil_cuci" class="label-data" style="margin-top: 6px !important">
                                    0
                                </h4>
                                <div style="margin-top: -10px !important">
                                    <span class="size15" >pcs</span>
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
                        <div class="card-icon" style="background-color: rgba(255, 204, 0, 0.30);
                        border-radius: 8px;">
                            <img src="{{asset('assets/icon/scissors-cut-fill-kuning.png')}}" alt="" srcset="">
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 class="size10" style="margin-top: -6px !important">Hasil Potong</h4>
                            </div>
                            <div class="card-body">
                                <h4 id="hasil_potong" class="label-data" style="margin-top: 6px !important">0</h4>
                                <div style="margin-top: -10px !important">
                                    <span class="size15">pcs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon" style="background-color: rgba(51, 199, 88, 0.3);
                        border-radius: 8px;">
                            <img src="{{asset('assets/icon/search-eye-fill-hijau.png')}}" alt="" srcset="">
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 class="size10" style="margin-top: -6px !important">Siap Quality Control</h4>
                            </div>
                            <div class="card-body">

                                <h4 id="siap_qc" class="label-data"  style="margin-top: 6px !important"> 0</h4>
                                <div style="margin-top: -10px !important">
                                    <span class="size15">pcs</span>
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
                        <div class="card-icon" style="background-color: rgba(255, 149, 0, 0.3);
                        border-radius: 8px;">
                            <img src="{{asset('assets/icon/user-settings-fill-orange.png')}}" alt="" srcset="">
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 class="size10" style="margin-top: -6px !important">Berhasil Jahit</h4>
                            </div>
                            <div class="card-body">
                                <h4 id="berhasil_jahit" class="label-data" style="margin-top: 6px !important"> 0</h4>
                                <div style="margin-top: -10px !important">
                                    <span class="size15">pcs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon" style="background-color: rgba(255, 56, 46, 0.3);
                        border-radius: 8px;">
                            <img src="{{asset('assets/icon/t-shirt-air-fill-merah.png')}}" alt="" srcset="">
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4 class="size10" style="margin-top: -6px !important"> Rusak / Buang</h4>
                            </div>
                            <div class="card-body">
                                <h4 id="baju_rusak" class="label-data" style="margin-top: 6px !important">0</h4>
                                <div style="margin-top: -10px !important">
                                    <span class="size15">pcs</span>
                                </div>
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
                    <h4 class="text-dark">Daftar Potong</h4>
                    <div class="card-header-action">
                        <a href="{{route('potong.index')}}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body" style="margin-top: -30px">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="table-cutting">
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>Nomor SKU</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Daftar Jahit</h4>
                    <div class="card-header-action">
                        <a href="{{route('jahit.index')}}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body" style="margin-top: -30px">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="table-jahit">
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>Nomor SKU</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Daftar Cuci</h4>
                    <div class="card-header-action">
                        <a href="{{route('cuci.index')}}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body" style="margin-top: -30px">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="table-cuci">
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>Nomor SKU</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>



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
                    <h4 class="text-center">Jumlah Kain</h4>
                    <canvas id="barChart" width="400" height="300"></canvas>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Proses Produksi</h4>
                    <canvas id="pieChart" width="400" height="300"></canvas>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Pesanan Tiap Tahun</h4>
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
            language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
            "bAutoWidth": false,
             data:[],
                columns: [
                { "data": "bahan.kode_transaksi"  },
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
            language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
            "bAutoWidth": false,
            data:[],
                columns: [
                { "data": "potong.bahan.kode_transaksi"  },
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
            language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
            "bAutoWidth": false,
            data:[],
                columns: [
                { "data": "jahit.potong.bahan.kode_transaksi"  },
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



        function barChartData(data, label) {
            var ctx = document.getElementById('barChart').getContext('2d');
         barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: label,
                datasets: [{
                    label: 'Jumlah Kain',
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

        function pieChartData(label, data)
        {
            var ctx = document.getElementById("pieChart").getContext('2d');
             pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: label,
                datasets: [{
                backgroundColor: [
                    "#2ecc71",
                    "#ffc800",
                    "#00a2ff",
                    "#ff0000",
                ],
                data: data
                }]
            },
            options: {
                legend: {
                position: 'bottom',
              }
             }
            });
        }


        function lineChartData(label, data) {
            var ctx = document.getElementById('lineChart').getContext('2d');
         lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: label,
                datasets: [{
                    label: 'Pesanan',
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

         function cleartable() {
            table_cutting.clear().draw();
            table_jahit.clear().draw();
            table_cuci.clear().draw();
          }


          $.ajax({
                url:"{{route('dashboard.index')}}",
                method:"GET",
                success:function(data){
                    console.log(data);
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


                        var group_kain = data.group_kain
                        var bulanbar = []
                        var databar = []
                        var pie = data.pie;
                        group_kain.forEach(element => {
                                bulanbar.push(element.months)
                                databar.push(element.jumlah)
                        });

                        var line_data = data.line;
                        var bulanline = []
                        var dataline = []
                        line_data.forEach(element => {
                                bulanline.push(element.months)
                                dataline.push(element.jumlah)
                        });
                        pieChartData(pie.label,pie.data)
                        barChartData(databar, bulanbar)
                        lineChartData(bulanline, dataline)
                        table_cutting.rows.add(data.potong).draw();
                        table_jahit.rows.add(data.jahit).draw();
                        table_cuci.rows.add(data.cuci).draw();

                        $('#jumlah_kain').text(data.jumlah_kain)
                        $('#labelarrow').html('<i class="ri-arrow-right-up-line"></i> Lebih banyak '+data.jumlah_kain_lalu+' yard dari bulan lalu')
                        $('#jenis_bahan').html(data.jenis_bahan)
                        $('#berhasil_cuci').text(data.berhasil_cuci)
                        $('#berhasil_dari_cuci').text(data.berhasil_jahit+' pcs')
                        $('#siap_qc').text(data.berhasil_cuci)
                        $('#hasil_potong').text(data.hasil_cutting)
                        $('#berhasil_jahit').html(data.berhasil_jahit)
                        // $('#berhasil_jahit').html(data.berhasil_jahit+'  <span class="size12">dari '+data.hasil_cutting+' pcs</span>')
                        $('#baju_rusak').text(data.baju_rusak)
                        $('#bulan').val(data.bulan).attr('selected','selected')
                        $('#tahun').val(data.tahun).attr('selected','selected')
                    }
                }
            })

        $('#bulan, #tahun').on('change', function () {
            var bulan = $('#bulan').find(':selected').val()
            var tahun = $('#tahun').find(':selected').val()
            cleartable()
            $.ajax({
                url:"{{route('dashboard.index')}}",
                method:"GET",
                data:{
                    'bulan':bulan,
                    'tahun':tahun,
                    'status':'change'
                },success:function(data){

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

                        var group_kain = data.group_kain
                        var bulanbar = []
                        var databar = []
                        var pie = data.pie;
                        group_kain.forEach(element => {
                                bulanbar.push(element.months)
                                databar.push(element.jumlah)
                        });

                        var line_data = data.line;
                        var bulanline = []
                        var dataline = []
                        line_data.forEach(element => {
                                bulanline.push(element.months)
                                dataline.push(element.jumlah)
                        });
                        pieChartData(pie.label,pie.data)
                        barChartData(databar, bulanbar)
                        lineChartData(bulanline, dataline)
                        table_cutting.rows.add(data.potong).draw();
                        table_jahit.rows.add(data.jahit).draw();
                        table_cuci.rows.add(data.cuci).draw();
                        $('#jumlah_kain').text(data.jumlah_kain)
                        $('#labelarrow').html('<i class="ri-arrow-right-up-line"></i> Lebih banyak '+data.jumlah_kain_lalu+' yard dari bulan lalu')
                        $('#jenis_bahan').html(data.jenis_bahan)
                        $('#berhasil_cuci').text(data.berhasil_cuci)
                        // $('#berhasil_cuci').html(data.berhasil_cuci+'  <span class="size12">dari '+data.berhasil_jahit+' pcs</span>')
                        $('#berhasil_dari_cuci').text(data.berhasil_jahit+' pcs')

                        $('#siap_qc').html(data.berhasil_cuci)
                        $('#hasil_potong').html(data.hasil_cutting)
                        $('#berhasil_jahit').text(data.berhasil_jahit)
                        // $('#berhasil_jahit').html(data.berhasil_jahit+'  <span class="size12">dari '+data.hasil_cutting+' pcs</span>')
                        $('#baju_rusak').text(data.baju_rusak)
                    }
                }
            })
         })
     })
</script>
@endpush
@endif


{{-- warehouse --}}
@if (auth()->user()->hasRole('warehouse'))
@section('content')
<style>
    .gray {
        color: #AEAEB2;
        font-size: 14px;
    }

    .selectgrey {
        background-color: #E5E5EA;
    }

    .size10 {
        font-size: 9px !important;
    }

    .size12 {
        font-size: 11px !important;
        color: #AEAEB2;
    }

    th {
        font-size: 10px;
        text-align: center;
    }

    td {
        text-align: center;
        font-size: 10px;
    }
    .size15 {
        font-size: 15px !important;
        color: #AEAEB2;
    }

    .label-data {
        font-size: 16px !important;
    }

    .badge {
        font-size: 10px;
    }
</style>
<section class="section mt-3">

    <div class="row">
        <div class="col-md-12 text-right">
            <div class="row">
                <div class="col-md-9">

                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control selectgrey" id="bulan">
                                    @forelse ($month as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control selectgrey" id="tahun">
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

        <div class="col-md-3">
            <div class="card card-statistic-1">
                <div class="card-icon " style="background-color: rgba(26, 205, 255, 0.30);
                border-radius: 8px;">
                    <img src="{{asset('assets/icon/t-shirt-fill-biru.png')}}" alt="" srcset="">
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="size10">Jumlah Produk Siap Jual</h4>
                    </div>
                    <div class="card-body">

                        <h2 id="rekap" class="label-data" style="margin-top: 6px !important">
                            0
                        </h2>
                        <div style="margin-top: -10px !important">
                            <span class="size15" >pcs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic-1">
                <div class="card-icon" style="background-color: rgba(255, 149, 0, 0.3);
                border-radius: 8px;">
                    <img src="{{asset('assets/icon/logout-box-fill-orange.png')}}" alt="" srcset="">
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="size10">Jumlah Baju Diretur</h4>
                    </div>
                    <div class="card-body">

                        <h2 id="retur" class="label-data" style="margin-top: 6px !important">
                            0
                        </h2>
                        <div style="margin-top: -10px !important">
                            <span class="size15" >pcs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic-1">
                <div class="card-icon" style="background-color: rgba(255, 56, 46, 0.3);
                border-radius: 8px;">
                    <img src="{{asset('assets/icon/t-shirt-air-fill-merah.png')}}" alt="" srcset="">
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="size10">Jumlah Produk Dibuang</h4>
                    </div>
                    <div class="card-body">

                        <h2 id="buang" class="label-data" style="margin-top: 6px !important">
                            0
                        </h2>
                        <div style="margin-top: -10px !important">
                            <span class="size15" >pcs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-statistic-1">
                <div class="card-icon" style="background-color: rgba(51, 199, 88, 0.3);
                border-radius: 8px;">
                    <img src="{{asset('assets/icon/money-dollar-circle-fill-hijau.png')}}" alt="" srcset="">
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4 class="size10">Rata-rata Harga Produk /pcs</h4>
                    </div>
                    <div class="card-body">

                        <h2 id="avg" class="label-data" style="margin-top: 6px !important">
                            0
                        </h2>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Daftar Finishing</h4>
                    <div class="card-header-action">
                        <a href="{{route('warehouse.finishing.index')}}">Lihat Semua <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body" style="margin-top: -30px">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="table-finish">
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>SKU</th>
                                    <th>Berhasil</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Daftar Warehouse</h4>
                    <div class="card-header-action">
                        <a href="{{route('warehouse.warehouse.index')}}">Lihat Semua <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body" style="margin-top: -30px">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="table-warehouse">
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>SKU</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">Daftar Retur</h4>
                    <div class="card-header-action">
                        <a href="{{route('warehouse.retur.index')}}">Lihat Semua <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="card-body" style="margin-top: -30px">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="table-retur">
                            <thead>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <th>SKU</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

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
                    <h4 class="text-center">Produk Terjual</h4>
                    <canvas id="barChart" width="400" height="300"></canvas>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Status Produk</h4>
                    <canvas id="pieChart" width="400" height="300"></canvas>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Produk Terjual Tiap Tahun</h4>
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
       var table_finish = $('#table-finish').DataTable({
            "searching": false,
            "info": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
            "bAutoWidth": false,
             data:[],
                columns: [
                { "data": "cuci.jahit.potong.bahan.kode_transaksi"  },
                { "data": "cuci.jahit.potong.bahan.sku" },
                { "data": "barang_lolos_qc" }
            ]

        })

     var table_warehouse =   $('#table-warehouse').DataTable({
            "searching": false,
            "info": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
            "bAutoWidth": false,
            data:[],
                columns: [
                { "data": "finishing.cuci.jahit.potong.bahan.kode_transaksi"  },
                { "data": "finishing.cuci.jahit.potong.bahan.sku" },
                { "data": "harga_produk" }
            ],

        })

       var table_retur =   $('#table-retur').DataTable({
            "searching": false,
            "info": false,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
            "bAutoWidth": false,
            data:[],
                columns: [
                { "data": "finishing.cuci.jahit.potong.bahan.kode_transaksi"  },
                { "data": "finishing.cuci.jahit.potong.bahan.sku" },
                { "data": "total_barang" }
            ]
        })



        function barChartData(data, label) {
            var ctx = document.getElementById('barChart').getContext('2d');
         barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: label,
                datasets: [{
                    label: 'Jumlah Produk',
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

        function pieChartData(label, data)
        {
            var ctx = document.getElementById("pieChart").getContext('2d');
             pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: label,
                datasets: [{
                backgroundColor: [
                    "#2ecc71",
                    "#ffc800",
                    "#00a2ff",
                    "#ff0000",
                ],
                data: data
                }]
            },
            options: {
                legend: {
                position: 'bottom',
              }
             }
            });
        }


        function lineChartData(label, data) {
            var ctx = document.getElementById('lineChart').getContext('2d');
         lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: label,
                datasets: [{
                    label: 'Produk',
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
                url:"{{route('warehouse.dashboard.index')}}",
                method:"GET",
                success:function(data){

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

                        var group_kain = data.bar
                        var bulanbar = []
                        var databar = []
                        var pie = data.pie;
                        group_kain.forEach(element => {
                                bulanbar.push(element.months)
                                databar.push(element.jumlah)
                        });

                        var line_data = data.line;
                        var bulanline = []
                        var dataline = []
                        line_data.forEach(element => {
                                bulanline.push(element.months)
                                dataline.push(element.jumlah)
                        });
                        pieChartData(pie.label,pie.data)
                        barChartData(databar, bulanbar)
                        lineChartData(bulanline, dataline)
                        table_finish.rows.add(data.finish).draw();
                        table_warehouse.rows.add(data.warehouse).draw();
                        table_retur.rows.add(data.dataretur).draw();
                        $('#rekap').text(data.rekap)
                        $('#retur').text(data.retur)
                        $('#buang').text(data.buang)
                        $('#avg').html('<span class="size12">Rp.</span> '+data.avg)
                        $('#bulan').val(data.bulan).attr('selected','selected')
                        $('#tahun').val(data.tahun).attr('selected','selected')
                    }
                }
            })

        $('#bulan, #tahun').on('change', function () {
            var bulan = $('#bulan').find(':selected').val()
            var tahun = $('#tahun').find(':selected').val()
            table_finish.clear().draw;
            table_warehouse.clear().draw;
            table_retur.clear().draw;
            $.ajax({
                url:"{{route('warehouse.dashboard.index')}}",
                method:"GET",
                data:{
                    'bulan':bulan,
                    'tahun':tahun,
                    'status':'change'
                },success:function(data){
                    console.log(data);
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

                        var group_kain = data.bar
                        var bulanbar = []
                        var databar = []
                        var pie = data.pie;
                        group_kain.forEach(element => {
                                bulanbar.push(element.months)
                                databar.push(element.jumlah)
                        });

                        var line_data = data.line;
                        var bulanline = []
                        var dataline = []
                        line_data.forEach(element => {
                                bulanline.push(element.months)
                                dataline.push(element.jumlah)
                        });
                        pieChartData(pie.label,pie.data)
                        barChartData(databar, bulanbar)
                        lineChartData(bulanline, dataline)
                        table_finish.rows.add(data.finish).draw();
                        table_warehouse.rows.add(data.warehouse).draw();
                        table_retur.rows.add(data.dataretur).draw();
                        $('#rekap').text(data.rekap)
                        $('#retur').text(data.retur)
                        $('#buang').text(data.buang)
                        $('#avg').html('<span class="size12">Rp.</span> '+data.avg)

                    }
                }
            })
         })
     })
</script>
@endpush
@endif
