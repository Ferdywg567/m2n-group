@extends('backend.master')

@section('title', 'Retur')
@section('title-nav', 'Retur')
@section('retur', 'class=active')

@section('content')
<section class="section mt-5">
    <a href="{{route('print.index')}}" class="btn btn-outline-primary rounded ml-1">Print Semua <i
            class="fas fa-print"></i>
    </a>
    <div class="section-body mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <table class="table table-hover" id="tableretur">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Bahan</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Tgl Masuk</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Warna</th>
                                    <th scope="col">Ukuran</th>
                                    <th scope="col">Barang Return</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="">

                                @forelse ($retur as $item)
                                @php
                                $ukuran = '';
                                @endphp
                                @forelse ($item->detail_retur as $row)
                                @php
                                $ukuran .= $row->ukuran . ', ';
                                @endphp
                                @empty

                                @endforelse
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}</td>
                                <td>{{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->sku}}</td>
                                <td>{{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->tanggal_masuk}}</td>
                                <td>{{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}</td>
                                <td>{{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->warna}}</td>
                                <td>{{$ukuran}}</td>
                                <td>{{$item->total_barang}} pcs</td>
                                <td>
                                    <a href="{{route('warehouse.retur.show',[$item->id])}}"
                                        class="btn btn-outline-primary">Detail</a>
                                </td>
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

              $('#tableretur').DataTable()


     })
</script>
@endpush
