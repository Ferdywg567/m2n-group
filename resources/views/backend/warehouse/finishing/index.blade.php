@extends('backend.master')

@section('title', 'Finishing')

@section('finishing', 'class=active')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <h1>Finishing</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h4>Latest Posts</h4> --}}
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary " data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Input Data <i class="fas fa-plus"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <form action="{{route('warehouse.finishing.create')}}" method="get">
                                            <input type="hidden" name="status" value="masuk">
                                            <button class="dropdown-item">Finishing</button>
                                        </form>

                                        <form action="{{route('warehouse.finishing.create')}}" method="get">
                                            <input type="hidden" name="status" value="keluar">
                                            <button class="dropdown-item">Kirim Warehouse</button>
                                        </form>

                                    </div>
                                </div>

                                <button class="btn btn-outline-primary">Print Semua <i class="fas fa-print"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="ml-2">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-masuk-tab" data-toggle="tab"
                                            href="#nav-masuk" role="tab" aria-controls="nav-masuk"
                                            aria-selected="true">Finishing</a>
                                        <a class="nav-item nav-link" id="nav-keluar-tab" data-toggle="tab"
                                            href="#nav-keluar" role="tab" aria-controls="nav-keluar"
                                            aria-selected="false">Kirim Warehouse</a>
                                    </div>
                                </nav>
                            </div>
                            <div class="tab-content ml-2 mr-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-masuk" role="tabpanel"
                                    aria-labelledby="nav-masuk-tab">
                                    <table class="table table-hover" id="tabelmasuk">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Bahan</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Jenis Kain</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Ukuran</th>
                                                <th scope="col">Tgl Masuk</th>
                                                <th scope="col">Tgl Finishing</th>
                                                <th scope="col">Berhasil Finishing</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">

                                            @forelse ($finish as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}</td>
                                                <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->sku}}</td>
                                                <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan}}
                                                </td>
                                                <td>{{$item->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}</td>
                                                <td>
                                                    @php
                                                        $ukuran = '';

                                                    @endphp

                                                    @forelse ($item->detail_finish as $key => $row)
                                                             @php
                                                            $ukuran .= $row->ukuran . ', ';
                                                            @endphp
                                                    @empty

                                                    @endforelse
                                                    {{rtrim($ukuran,", ")}}
                                                </td>
                                                <td>{{$item->tanggal_masuk}}</td>
                                                <td>{{$item->tanggal_qc}}</td>
                                                <td>{{$item->barang_lolos_qc}}/{{$item->rekapitulasi->total_barang}}</td>
                                                <td>
                                                    <div class="dropdown dropleft">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center"
                                                            aria-labelledby="dropdownMenuButton">

                                                            <a class="dropdown-item"
                                                                href="{{route('warehouse.finishing.show',[$item->id])}}"><i
                                                                    class="fas fa-eye"></i>
                                                                Detail</a>
                                                            <a class="dropdown-item btnprintmasuk" href="#"
                                                                data-id="{{$item->id}}"><i class="fas fa-print"></i>
                                                                Print</a>
                                                            <a class="dropdown-item"
                                                                href="{{route('warehouse.finishing.edit',[$item->id])}}"><i
                                                                    class="fas fa-edit"></i>
                                                                Edit</a>
                                                            <a class="dropdown-item hapus" data-id="{{$item->id}}"
                                                                href="#"><i class="fa fa-trash"></i>
                                                                Delete</a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty

                                            @endforelse

                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="nav-keluar" role="tabpanel"
                                    aria-labelledby="nav-keluar-tab">
                                    <table class="table table-hover" id="tabelbahankeluar">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Bahan</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Tgl Finishing</th>
                                                <th scope="col">Vendor Finishing</th>
                                                <th scope="col">Finishing Sukses</th>
                                                <th scope="col">Finishing Gagal</th>

                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            {{-- @forelse ($jahitkeluar as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                            <td>{{$item->potong->bahan->kode_bahan}}</td>
                                            <td>{{$item->potong->bahan->sku}}</td>
                                            <td>{{$item->tanggal_jahit}}</td>
                                            <td>{{$item->vendor}}</td>
                                            <td>{{$item->berhasil}}</td>
                                            <td>{{$item->gagal_jahit}}</td>

                                            <td>
                                                <span
                                                    class="badge badge-success text-dark">{{$item->status_jahit}}</span>
                                            </td>

                                            <td>
                                                <div class="dropdown dropleft">
                                                    <a class="" href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </a>
                                                    <div class="dropdown-menu text-center"
                                                        aria-labelledby="dropdownMenuButton">

                                                        <a class="dropdown-item"
                                                            href="{{route('warehouse.finishing.show',[$item->id])}}"><i
                                                                class="fas fa-eye"></i>
                                                            Detail</a>
                                                        <a class="dropdown-item"
                                                            href="{{route('warehouse.finishing.edit',[$item->id])}}"><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item hapus" data-id="{{$item->id}}"
                                                            href="#"><i class="fa fa-trash"></i>
                                                            Delete</a>

                                                    </div>
                                                </div>
                                            </td>
                                            </tr>
                                            @empty

                                            @endforelse --}}



                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</div>
<div id="printable">
    <h1>Hello print</h1>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
             function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              }
              $('#kdbahanreadonly').hide()
              $('#ukuranm').hide()
              $('#ukuranl').hide()
              $('#ukuranxl').hide()
              $('#ukuranxxl').hide()
              $('#idnamavendor').hide()
              $('#datavendor').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('#kode_bahanselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')
              $('#jahitMasuk').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#jahitMasukLabel').text('Input Data [jahit Masuk]')
                $('#alert-jahit-masuk').empty()
                $('.btnmasuk').prop('id','btnsimpanmasuk')
                $('.btnmasuk').show()
                $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#datavendor').hide()
              });



     })
</script>
@endpush
