@extends('backend.master')

@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')

@section('content')
<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }

    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;
    }

    .left {
        text-align: left;
    }
</style>
<div id="non-printable">
    <section class="section mt-4">
        <div class="btn-group">
            {{-- <a href="{{route('rekapitulasi.create')}}" class="btn btn-primary ">
            Input Data <i class="fas fa-plus"></i>
            </a> --}}
            <a href="{{route('print.index')}}" class="btn btn-outline-primary rounded ml-1">Cetak Semua <i
                    class="ri-printer-fill"></i>
            </a>
        </div>
        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <table class="table table-hover" id="tablerekap">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Transaksi</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Warna</th>
                                        <th scope="col">Perbaikan</th>
                                        <th scope="col">Dibuang</th>
                                        <th scope="col">Asal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($rekap as $item)
                                    @if (!empty($item->cuci_id))
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->cuci->jahit->potong->bahan->kode_transaksi}}</td>
                                        <td>{{$item->cuci->jahit->potong->bahan->sku}}</td>
                                        <td>{{$item->cuci->jahit->potong->bahan->nama_bahan}}</td>
                                        <td>{{$item->cuci->jahit->potong->bahan->warna}}</td>
                                        <td>{{$item->jumlah_diperbaiki}} pcs</td>
                                        <td>{{$item->jumlah_dibuang}} pcs</td>
                                        <td>Cuci</td>
                                        <td>
                                            <a href="{{route('rekapitulasi.show',[$item->id])}}"
                                                class="btn btn-outline-primary">Detail</a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->jahit->potong->bahan->kode_transaksi}}</td>
                                        <td>{{$item->jahit->potong->bahan->sku}}</td>
                                        <td>{{$item->jahit->potong->bahan->nama_bahan}}</td>
                                        <td>{{$item->jahit->potong->bahan->warna}}</td>
                                        <td>{{$item->jumlah_diperbaiki}} pcs</td>
                                        <td>{{$item->jumlah_dibuang}} pcs</td>
                                        <td>Jahit</td>
                                        <td>
                                            <a href="{{route('rekapitulasi.show',[$item->id])}}"
                                                class="btn btn-outline-primary">Detail</a>
                                        </td>
                                    </tr>
                                    @endif

                                    @empty
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tablerekap').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('#kode_bahanselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')
              $('#rekapitulasiMasuk').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $('#rekapitulasiMasukLabel').text('Input Data [rekapitulasi Masuk]')
                $('#alert-rekapitulasi-masuk').empty()
                $('.btnmasuk').prop('id','btnsimpanmasuk')
                $('.btnmasuk').show()
                $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              });

     })
</script>
@endpush
