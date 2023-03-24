@extends('backend.master')

@section('title', 'Warehouse')
@section('title-nav', 'Warehouse')

@section('warehouse', 'class=active-sidebar')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('warehouse.warehouse.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Warehouse</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.warehouse.cetak')}}" target="_blank" method="post">
                            @csrf

                                <input type="hidden" name="id" id="idbahan" value="{{$warehouse->id}}">
                            <div class="card-body">
                                @include('backend.include.alert')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$warehouse->finishing->cuci->jahit->potong->bahan->kode_transaksi}}"
                                                required id="kode_transaksi" name="kode_transaksi">
                                        </div>


                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                value="{{$warehouse->finishing->cuci->jahit->potong->bahan->sku}}"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" readonly required id="jenis_bahan"
                                                value="{{$warehouse->finishing->cuci->jahit->potong->bahan->jenis_bahan}}"
                                                name="jenis_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                value="{{$warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan}}"
                                                name="nama_bahan">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna Baju</label>
                                            <input type="text" class="form-control" readonly required
                                                value="{{$warehouse->finishing->cuci->jahit->potong->bahan->warna}}"
                                                id="warna_baju_keluar" name="warna_baju">
                                        </div>

                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="siap_jual">Produk Siap Jual</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    value="{{$warehouse->detail_warehouse->sum('jumlah')}}"
                                                    id="siap_jual" name="siap_jual">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_produk">Harga Produk</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp.</div>
                                                </div>
                                                <input type="number" class="form-control" required id="harga_produk"
                                                    value="{{$warehouse->harga_produk}}" name="harga_produk" readonly>
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">/pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    @if ($seri)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_seri">Harga Produk (S,M,L)</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp.</div>
                                                </div>
                                                <input disabled type="number" class="form-control harga" required id="harga_seri"
                                                    value="{{$harga_seri}}" name="harga_seri">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">/seri</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @forelse ($detail as $item)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="ukuran_harga[]" value="{{$item->ukuran}}">
                                            <label for="harga_produk">Harga Produk ({{$item->ukuran}})</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp.</div>
                                                </div>
                                                <input disabled type="number" class="form-control harga" required id="harga_produk"
                                                    value="{{$item->harga}}" name="harga_produk[]">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">/seri</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($loop->iteration % 6 ==0)
                                    </div><div class="row">
                                    @endif
                                    @empty
                                    @endforelse
                                </div>


                                <div class="row" id="ukuran">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="idukuran" style="margin-top: -25px;">
                                    @forelse ($warehouse->detail_warehouse as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukuran[]" value="{{$item->ukuran}}">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->ukuran}}</div>
                                            </div>
                                            <input type="number" class="form-control" required id="jumlah" readonly
                                                name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @if ($loop->iteration % 6 ==0)
                                    </div><div class="row">
                                    @endif
                                    @empty
                                    @endforelse
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('warehouse.warehouse.index')}}">Tutup</a>
                                            <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i> Cetak</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@push('scripts')
<script>
    $('.harga').mask('000.000.000.000', {
        reverse: true
    });
</script>
@endpush