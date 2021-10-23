@extends('ecommerce.offline.master')
@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')
@section('content')
<style>
    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;
    }
</style>
<section class="section mt-4">

    <div class="section-body mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kode_transaksi">Kode Transaksi</label>
                                    <input type="text" class="form-control" readonly required id="kode_transaksi"
                                        name="kode_transaksi" value="{{$transaksi->kode_transaksi}}">
                                </div>
                            </div>
                        </div>
                        <table class="table table-hover" id="tabelrekap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                @forelse ($transaksi->detail_transaksi as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->produk->kode_produk}}</td>
                                    <td>{{$item->produk->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}
                                    </td>
                                    <td>{{$item->jumlah}}</td>
                                    <td>@rupiah($item->harga)</td>
                                    <td>@rupiah($item->total_harga)</td>
                                </tr>
                                @empty

                                @endforelse

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-8 float-left text-left">
                                <div class="form-group mt-2" style="padding-left: 50px;">
                                    <h4>Total</h4>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" readonly required id="total_harga"
                                    name="total_harga" value="@rupiah($transaksi->total_harga)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 float-left text-left">
                                <div class="form-group mt-2" style="padding-left: 50px;">
                                    <h4>Bayar</h4>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" readonly required id="bayar" name="bayar"
                                    value="@rupiah($transaksi->bayar)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 float-left text-left">
                                <div class="form-group mt-2" style="padding-left: 50px;">
                                    <h4>Kembalian</h4>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" readonly required id="kembalian"
                                    name="kembalian" value="@rupiah($transaksi->kembalian)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a type="button" class="btn btn-secondary"
                                    href="{{route('offline.rekapitulasi.index')}}">Tutup</a>
                                <a type="button" class="btn btn-primary"
                                    href="{{route('offline.rekapitulasi.cetak',[$transaksi->id])}}" target="_blank"><i
                                        class="ri-printer-fill"></i> Cetak</a>
                                {{-- <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i>
                                    Cetak</button> --}}
                            </div>
                        </div>
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


              $('#tabelrekap').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })


     })
</script>
@endpush
