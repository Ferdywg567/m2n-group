@extends('backend.master')

@section('title', 'Potong')
@section('title-nav', 'Potong')
@section('potong', 'class=active-sidebar')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('potong.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Detail Data | Potong</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @include('backend.include.alert')
                            <form action="{{route('potong.cetak')}}" target="_blank" method="post">
                                @csrf
                                <input type="hidden" name="id" id="idpotong" value="{{$potong->id}}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>

                                            <div id="kdbahanmasuk">
                                                <input type="text" class="form-control"
                                                    value="{{$potong->bahan->kode_transaksi}}" readonly
                                                    id="kdbahanreadmasuk" name="kdbahanreadmasuk">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" value="{{$potong->no_surat}}" readonly
                                                required id="no_surat" name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_potong">Tanggal Potong</label>
                                            <input type="date" class="form-control" required readonly id="tanggal_potong"  value="{{$potong->tanggal_cutting}}"
                                                name="tanggal_potong">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimasi_selesai_potong">Estimasi Selesai Potong</label>
                                            <input type="date" class="form-control" required readonly
                                                id="estimasi_selesai_potong" name="estimasi_selesai_potong" value="{{$potong->tanggal_selesai}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_kain">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required id="jenis_kain" value="{{$potong->bahan->jenis_bahan}}"
                                                name="jenis_kain">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna Kain</label>
                                            <input type="text" class="form-control" readonly required id="warna" value="{{$potong->bahan->warna}}"
                                                name="warna">
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk" value="{{$potong->bahan->nama_bahan}}"
                                                name="nama_produk">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku" value="{{$potong->bahan->sku}}"
                                                name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori" value="{{$potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori" value="{{$potong->bahan->detail_sub->sub_kategori->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly
                                                id="detail_sub_kategori" name="detail_sub_kategori" value="{{$potong->bahan->detail_sub->nama_kategori}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panjang_kain">Panjang kain</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="panjang_kain" name="panjang_kain" value="{{$potong->bahan->panjang_bahan_diambil}}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hasil_cutting">Hasil Cutting</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required id="hasil_cutting" max="{{$potong->bahan->panjang_bahan}}" value="{{$potong->hasil_cutting}}"
                                                    name="hasil_cutting" >
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="konversi">Konversi</label>
                                            <input type="text" class="form-control" required readonly value="{{$potong->konversi}}"
                                                    id="konversi" name="konversi">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="datasub">
                                    @forelse ($potong->detail_potong as $item)
                                    <div class="row">
                                        <input type="hidden" name="nilai" id="nilai" value="1">
                                        <input type="hidden" name="idukuran" id="idukuran" value="{{$item->id}}">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ukuran">Ukuran</label>
                                                <input type="text" class="form-control" readonly value="{{$item->size}}" required id="ukuran"
                                                    name="ukuran[]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" class="form-control" readonly value="{{$item->jumlah}}" required id="jumlah" name="jumlah[]">
                                            </div>
                                        </div>
                                    </div>
                                    @empty

                                    @endforelse

                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                        href="{{route('potong.index')}}">Close</a>
                                        <button type="submit" class="btn btn-primary"><i class="ri-printer-fill"></i> Print</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
