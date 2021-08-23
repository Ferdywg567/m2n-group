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
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}"
                                                required id="kode_bahan" name="kode_bahan">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                value="{{$warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->sku}}"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" readonly required id="jenis_bahan"
                                                value="{{$warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan}}"
                                                name="jenis_bahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                value="{{$warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}"
                                                name="nama_bahan">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna Baju</label>
                                            <input type="text" class="form-control" readonly required
                                                value="{{$warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->warna}}"
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
                                    <div class="col-md-6">
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
                                    </div>
                                </div>



                                <div class="row" id="ukuran">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="idukuran">
                                    @forelse ($warehouse->detail_warehouse as $item)
                                    @if ($item->ukuran == 'S')
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ukuran">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetails">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahs" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'M')
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahm" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'L')
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahl" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'XL')

                                    <div class="col-md-2" id="ukuranxl">
                                        <div class="form-group">
                                            <label for="ukuran">XL</label>
                                            <input type="hidden" name="dataukuran[]" value="XL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxl">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahxl" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @elseif($item->ukuran == 'XXL')
                                    <div class="col-md-2" id="ukuranxxl">
                                        <div class="form-group">
                                            <label for="ukuran">XXL</label>
                                            <input type="hidden" name="dataukuran[]" value="XXL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxxl">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahxxl" name="jumlah[]" value="{{$item->jumlah}}">
                                        </div>
                                    </div>
                                    @endif
                                    @empty
                                    @endforelse
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('warehouse.warehouse.index')}}">Close</a>
                                            <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i> Print</button>
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
