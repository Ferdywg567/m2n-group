@extends('backend.master')

@section('title', 'Pemotongan')
@section('title-nav', 'Pemotongan')
@section('potong', 'class=active-sidebar')

@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: 10px;
    }

</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('potong.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Edit Data | Potong Selesai</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @include('backend.include.alert')
                            <form action="{{route('potong.update',[$potong->id])}}" method="post" id="formPotong">
                                @csrf
                                @method('put')
                                <div class="alert " role="alert" id="dataalert">

                                </div>
                                <input type="hidden" name="status" value="potong selesai">
                                <input type="hidden" name="id" id="idmasuk">
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
                                            <input type="text" class="form-control" readonly value="{{$potong->no_surat}}"
                                                required id="no_surat" name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_potong">Tanggal Potong</label>
                                            <input type="date" class="form-control" required readonly
                                                id="tanggal_potong" value="{{$potong->tanggal_cutting}}"
                                                name="tanggal_potong">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimasi_selesai_potong">Estimasi Selesai Potong</label>
                                            <input type="date" class="form-control" required readonly
                                                id="estimasi_selesai_potong" name="estimasi_selesai_potong"
                                                value="{{$potong->tanggal_selesai}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_kain">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required id="jenis_kain"
                                                value="{{$potong->bahan->jenis_bahan}}" name="jenis_kain">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna Kain</label>
                                            <input type="text" class="form-control" readonly required id="warna"
                                                value="{{$potong->bahan->warna}}" name="warna">
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                value="{{$potong->bahan->nama_bahan}}" name="nama_produk">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                value="{{$potong->bahan->sku}}" name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                value="{{$potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori}}"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                value="{{$potong->bahan->detail_sub->sub_kategori->nama_kategori}}"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly
                                                id="detail_sub_kategori" name="detail_sub_kategori"
                                                value="{{$potong->bahan->detail_sub->nama_kategori}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panjang_kain">Panjang kain</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="panjang_kain" name="panjang_kain"
                                                    value="{{$potong->bahan->panjang_bahan_diambil}}">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hasil_cutting">Hasil Potong</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="hasil_cutting"
                                                    value="{{$potong->hasil_cutting}}" name="hasil_cutting">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="konversi">Konversi</label>
                                            <input type="text" class="form-control" required readonly
                                                value="{{$potong->konversi}}" id="konversi" name="konversi">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="datasub">
                                    @forelse ($potong->detail_potong as $item)
                                    <div class="row">
                                        <input type="hidden" name="nilai" id="nilai" value="1">
                                        <input type="hidden" name="idukuran" id="idukuran" value="{{$item->id}}">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="ukuran">Ukuran</label>
                                                <input type="text" class="form-control" value="{{$item->size}}" required
                                                    id="ukuran" name="ukuran[]">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" class="form-control" value="{{$item->jumlah}}" min="0"
                                                    required id="jumlah" name="jumlah[]">
                                            </div>
                                        </div>
                                    </div>
                                    @empty

                                    @endforelse

                                </div>
                                <button type="button" class="btn btn-outline-primary btn-block btntambah">Tambah
                                    Ukuran</button>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('potong.index')}}">Batal</a>

                                        <button type="submit" class="btn btn-primary btnmasuk">Update</button>

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
@push('scripts')
<script>
    $(document).ready(function () {
        $('#dataalert').hide()
        $('form[id=formPotong]').submit(function(){
                var jumlah = 0;
                var hasil = $('#hasil_cutting').val()
                $('input[name^="jumlah"]').each(function() {
                    jumlah = jumlah + parseInt($(this).val());
                });

                if(parseInt(jumlah) != parseInt(hasil)){
                    $('#dataalert').addClass('alert-danger')
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran harus sesuai dengan hasil potong')
                    return false;
                }else{

                   return true;
                }
                //add stuff here
            });
        $('#hasil_cutting').on('keyup', function(){
                  var data = $(this).val()
                  var lusin = 12

                  var sisa = data%lusin;
                  var hasil = (data - sisa) / lusin;
                  var res = hasil+' Lusin '+sisa+ ' pcs'
                  $('#konversi').val(res)
              })
        $('.btntambah').on('click', function () {
            // var nilai = $('#nilai').val()
                var nilai = 0
                var hide = $('#datasub').find('input[type=hidden]')
                var maxIndex;
                maxIndex = hide.length - 1;
                nilai = maxIndex+2
                var tambah = parseInt(nilai);
                var datahtml = '<div class="row">' +
                    '<input type="hidden" name="nilai" id="nilai" value="'+tambah+'">'+
                                            '<div class="col-md-5">'+
                                                '<div class="form-group">'+
                                                    '<label for="ukuran">Ukuran</label>'+
                                                    '<input type="text" class="form-control" required id="ukuran" name="ukuran[]">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-md-5">'+
                                                '<div class="form-group">'+
                                                    '<label for="jumlah">Jumlah</label>'+
                                                    '<input type="number" class="form-control"  required id="jumlah" name="jumlah[]" >'+
                                        '</div>'+

                                    '</div>'+
                                        '<div class="col-md-2" style="margin-top:30px" >'+
                                                '<button type="button" class="btn btn-danger btnHapus btn-block"><i class="ri-delete-bin-fill"></button>'+
                                        '</div>'+
                    '</div>'
                $('#datasub').append(datahtml)
            })


            $(document).on('click', '.btnHapus',function () {
                $(this).closest('.row').remove();
             })
     })
</script>
@endpush
