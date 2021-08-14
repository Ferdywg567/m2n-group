@extends('backend.master')

@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active')

@section('content')
<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
</style>
<div id="non-printable">
    <section class="section mt-5">
        <div class="btn-group">
            <a href="{{route('warehouse.rekapitulasi.create')}}" class="btn btn-primary rounded">
                Input Data <i class="fas fa-plus"></i>
            </a>
            <a href="{{route('print.index')}}" class="btn btn-outline-primary rounded ml-1">Print Semua <i
                    class="fas fa-print"></i>
            </a>
        </div>
        <div class="section-body mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <table class="table table-hover" id="tabelbahanmasuk">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Bahan</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Jenis Bahan</th>
                                        <th scope="col">Tgl Masuk</th>
                                        <th scope="col">Tgl Kirim</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Warna</th>
                                        <th scope="col">Siap QC</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($rekap as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}
                                        </td>
                                        <td>{{$item->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->sku}}
                                        </td>
                                        <td>{{$item->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan}}
                                        </td>
                                        <td>{{$item->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->tanggal_masuk}}
                                        </td>
                                        <td>{{$item->tanggal_kirim}}</td>
                                        <td>{{$item->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}
                                        </td>
                                        <td>{{$item->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->warna}}
                                        </td>
                                        <td>{{$item->total_barang}}</td>

                                        <td>
                                            <a href="{{route('warehouse.rekapitulasi.show',[$item->id])}}"
                                                class="btn btn-outline-primary">Detail</a>
                                        </td>
                                    </tr>
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
              $('#tabelbahanmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
     })
</script>
@endpush
