@extends('backend.master')

@section('title', 'Cuci')
@section('title-nav', 'Cuci')
@section('cuci', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -25px;
    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('jahit.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Masuk</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('cuci.store')}}" method="POST">
                            <div class="card-body">
                                @include('backend.include.alert')
                                @csrf
                                <input type="hidden" name="status" value="cucian masuk">
                                <input type="hidden" name="id" id="idmasuk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>

                                            <select class="form-control" id="kode_transaksiselect"
                                                name="kode_transaksi">
                                                <option value="">Pilih Kode Transaksi</option>
                                                @forelse ($jahit as $item)
                                                <option value="{{$item->id}}" @if($item->id ==
                                                    old('kode_transaksi')) selected
                                                    @endif> {{$item->potong->bahan->kode_transaksi}} |
                                                    {{$item->potong->bahan->nama_bahan}} |
                                                    {{$item->potong->bahan->detail_sub->nama_kategori}}
                                                </option>
                                                @empty

                                                @endforelse


                                            </select>


                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" value="{{old('no_surat')}}" required
                                                id="no_surat" readonly name="no_surat">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                value="{{old('nama_produk')}}" name="nama_produk">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                value="{{old('sku')}}" name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{old('kategori')}}" name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{old('sub_kategori')}}" name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly
                                                value="{{old('detail_sub_kategori')}}" id="detail_sub_kategori"
                                                name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_cuci">Tanggal Cuci</label>
                                            <input type="date" class="form-control" required id="tanggal_cuci"
                                                value="{{old('tanggal_cuci')}}" name="tanggal_cuci">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimasi_selesai_cuci">Estimasi Selesai Cuci</label>
                                            <input type="date" class="form-control" required id="estimasi_selesai_cuci"
                                                value="{{old('estimasi_selesai_cuci')}}" name="estimasi_selesai_cuci">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_vendor">Nama Vendor</label>
                                            <input type="text" class="form-control" id="nama_vendor" required
                                                name="nama_vendor" value="{{old('nama_vendor')}}">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga_vendor">Harga Vendor</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" required id="harga_vendor"
                                                        value="{{old('harga_vendor')}}" name="harga_vendor">
                                                </div>
                                                <div class="col-md-6">

                                                    <input type="text" class="form-control" value="/lusin" readonly
                                                        id="lusin" name="lusin">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jumlah_bahan_yang_dicuci">Jumlah Bahan Yang Dicuci</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required
                                                    value="{{old('jumlah_bahan_yang_dicuci')}}"
                                                    id="jumlah_bahan_yang_dicuci" readonly
                                                    name="jumlah_bahan_yang_dicuci">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" class="form-control" required readonly id="konversi"
                                                value="{{old('konversi')}}" name="konversi">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('jahit.index')}}">Batal</a>

                                        <button type="submit" class="btn btn-primary btnmasuk">Simpan</button>

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

              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_transaksiselect').select2()
              $('#title-ukuran').hide()


             $('#kode_transaksiselect').on('change', function () {
                    var id = $(this).find(':selected').val()

                    if(id != ''){
                        $.ajax({
                            url:"{{route('jahit.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var potong = data.potong
                                var bahan = potong.bahan
                                var detail = bahan.detail_sub.nama_kategori;
                                var subkategori = bahan.detail_sub.sub_kategori.nama_kategori;
                                var kategori = bahan.detail_sub.sub_kategori.kategori.nama_kategori;


                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#no_surat').val(data.no_surat)
                                $('#sku').val(bahan.sku)
                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(subkategori)
                                $('#detail_sub_kategori').val(detail)
                                $('#jumlah_bahan_yang_dicuci').val(data.berhasil)
                                $('#konversi').val(data.konversi)
                                // var content="";
                                // detail_potong.forEach((result, i) => {
                                //     if(i == 0){
                                //         content+= '<div class="row">'
                                //     }

                                //     content += '<div class="col-md-2">'+
                                //     '<input type="hidden" name="ukuran[]" value="'+result.size+'">'+
                                //     '<div class="input-group mb-2">'+
                                //         '<div class="input-group-prepend">'+
                                //             '<div class="input-group-text">'+result.size+'</div>'+
                                //         '</div>'+
                                //         '<input type="number" class="form-control" required id="jumlah" name="jumlah[]" value="'+result.jumlah+'">'+
                                //     '</div>'+
                                //    '</div>';
                                //     if(i!=0 && i%6 == 0){

                                //         // add end of row ,and start new row on every 5 elements
                                //         content += '</div><div class="row">'
                                //     }
                                // });
                                // $('#title-ukuran').show()
                                // $('#data-ukuran').html(content)

                            }

                        })
                    }
            })



     })
</script>
@endpush
