@extends('backend.master')

@section('title', 'Jahit')
@section('title-nav', 'Jahit')
@section('jahit', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav{
       margin-left:-25px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('jahit.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Edit Data | Masuk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('jahit.update',[$jahit->id])}}" method="POST">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="jahitan masuk">
                                <input type="hidden" name="id" id="idmasuk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>

                                            <div id="kdbahanmasuk">
                                                <input type="text" class="form-control" value="{{$jahit->potong->bahan->kode_transaksi}}" readonly id="kdbahanreadmasuk"
                                                    name="kode_transaksi">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" required id="no_surat" value="{{$jahit->no_surat}}"
                                                name="no_surat">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk" value="{{$jahit->potong->bahan->nama_bahan}}"
                                                name="nama_produk">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku" value="{{$jahit->potong->bahan->sku}}"
                                                name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"   value="{{$jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori" value="{{$jahit->potong->bahan->detail_sub->sub_kategori->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly value="{{$jahit->potong->bahan->detail_sub->nama_kategori}}"
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_jahit">Tanggal Jahit</label>
                                            <input type="date" class="form-control" required id="tanggal_jahit" value="{{$jahit->tanggal_jahit}}"
                                                name="tanggal_jahit">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimasi_selesai_jahit">Estimasi Selesai Jahit</label>
                                            <input type="date" class="form-control" required id="estimasi_selesai_jahit" value="{{$jahit->tanggal_selesai}}"
                                                name="estimasi_selesai_jahit">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="vendor_jahit">Vendor Jahit</label>
                                            <select class="form-control" id="vendor_jahit" name="vendor_jahit">
                                                <option value="internal" @if($jahit->vendor == 'internal') selected @endif >Internal</option>
                                                <option value="eksternal" @if($jahit->vendor == 'eksternal') selected @endif>Eksternal</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if ($jahit->vendor == 'eksternal')
                                <div class="row" id="datavendor">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" required id="nama_vendor" value="{{$jahit->nama_vendor}}"
                                                name="nama_vendor">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" required id="harga_vendor" value="{{$jahit->harga_vendor}}"
                                                        name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">

                                                    <input type="text" class="form-control" value="/lusin" readonly
                                                         id="lusin" name="lusin">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah_bahan_yang_dijahit">Jumlah Bahan Yang Dijahit</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required
                                                    id="jumlah_bahan_yang_dijahit" name="jumlah_bahan_yang_dijahit" value="{{$jahit->jumlah_bahan}}" max="{{$jahit->potong->panjang_bahan_diambil}}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" class="form-control" required readonly id="konversi" value="{{$jahit->konversi}}"
                                                name="konversi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="title-ukuran">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran Yang Dijahit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    @forelse ($jahit->detail_jahit as $item)
                                    <div class="col-md-2">
                                        <input type="hidden" name="dataukuran[]" value="{{$item->size}}" readonly>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">{{$item->size}}</div>
                                            </div>
                                            <input type="number" class="form-control" required id="jumlah"
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
                                            href="{{route('jahit.index')}}">Batal</a>

                                        <button type="submit" class="btn btn-primary btnmasuk">Update</button>

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
            //   $('#datavendor').hide()
              $('#kdbahanselectmasuk').show()

              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()




              $('#vendor_jahit').on('change', function () {
                  var data = $(this).find(':selected').val()

                  if(data == 'eksternal'){
                    $('#idnamavendor').show()
                    $('#datavendor').show()
                    $('#nama_vendor').prop('required',true)
                    $('#harga_vendor').prop('required',true)
                  }else{
                    $('#idnamavendor').hide()
                    $('#datavendor').hide()
                    $('#nama_vendor').prop('required',false)
                    $('#harga_vendor').prop('required',false)
                  }
               })

              $('#hasil_cutting').on('keyup', function(){
                  var data = $(this).val()
                  var lusin = 12

                  var sisa = data%lusin;
                  var hasil = (data - sisa) / lusin;
                  var res = hasil+' Lusin '+sisa+ ' pcs'
                  $('#konversi').val(res)
              })








     })
</script>
@endpush
