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
            <h1 class="ml-2">Input Data | Potong Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @include('backend.include.alert')
                            <div class="alert alert-danger" role="alert" id="dataalert">

                            </div>
                            <form action="{{route('potong.store')}}" method="post" id="formPotong">
                                @csrf
                                <input type="hidden" name="status" value="potong keluar">
                                <input type="hidden" name="id" id="idmasuk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <div id="kdbahanselectmasuk">
                                                <select class="form-control" id="kode_transaksi" name="kode_transaksi">
                                                    <option value="">Pilih Kode Transaksi</option>
                                                    @forelse ($keluar as $item)
                                                    <option value="{{$item->id}}">{{$item->bahan->kode_transaksi}} |
                                                        {{$item->bahan->nama_bahan}} | {{$item->bahan->detail_sub->nama_kategori}}
                                                    </option>
                                                    @empty

                                                    @endforelse


                                                </select>
                                            </div>

                                            <div id="kdbahanmasuk">
                                                <input type="text" class="form-control" readonly id="kdbahanreadmasuk"
                                                    name="kdbahanreadmasuk">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" required id="no_surat" readonly
                                                name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_potong">Tanggal Potong</label>
                                            <input type="date" class="form-control" required id="tanggal_potong"
                                                readonly name="tanggal_potong">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimasi_selesai_potong">Estimasi Selesai Potong</label>
                                            <input type="date" class="form-control" required readonly
                                                id="estimasi_selesai_potong" name="estimasi_selesai_potong">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_kain">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly required id="jenis_kain"
                                                name="jenis_kain">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna Kain</label>
                                            <input type="text" class="form-control" readonly required id="warna"
                                                name="warna">
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_produk"
                                                name="nama_produk">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <input type="text" class="form-control" required readonly id="kategori"
                                                name="kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sub_kategori">Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly id="sub_kategori"
                                                name="sub_kategori">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>
                                            <input type="text" class="form-control" required readonly
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="panjang_kain">Panjang kain</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="panjang_kain" name="panjang_kain">
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
                                                <input type="number" class="form-control" required id="hasil_cutting"  readonly
                                                    name="hasil_cutting">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="konversi">Konversi</label>
                                            <input type="text" class="form-control" required readonly id="konversi"
                                                name="konversi">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="datasub">

                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('potong.index')}}">Batal</a>

                                        <button type="submit" class="btn btn-primary btnmasuk btnsimpan">Simpan</button>

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
                console.log(jumlah);
                if(parseInt(jumlah) != parseInt(hasil)){
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran harus sesuai dengan hasil potong')
                    return false;
                }else{

                   return true;
                }
                //add stuff here
            });

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
              $('#tabelbahanmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_transaksi').select2()
              $('#kode_transaksikeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')
              $('#hasil_cutting').on('keyup', function(){
                  var data = $(this).val()
                  var lusin = 12

                  var sisa = data%lusin;
                  var hasil = (data - sisa) / lusin;
                  var res = hasil+' Lusin '+sisa+ ' pcs'
                  $('#konversi').val(res)
              })

              function generateUkuran(ukuran, jumlah)
              {
                var nilai = 0
                var hide = $('#datasub').find('input[type=hidden]')
                var maxIndex;
                maxIndex = hide.length - 1;
                nilai = maxIndex+2
                var tambah = parseInt(nilai);
                var datahtml = '<div class="row">' +
                    '<input type="hidden" name="nilai" id="nilai" value="'+tambah+'">'+
                                            '<div class="col-md-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="ukuran">Ukuran</label>'+
                                                    '<input type="text" class="form-control" readonly required id="ukuran" name="ukuran[]" value="'+ukuran+'" >'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="jumlah">Jumlah</label>'+
                                                    '<input type="number" class="form-control"  readonly required id="jumlah" name="jumlah[]" value="'+jumlah+'" >'+
                                        '</div>'+
                            '</div>'+
                    '</div>'
                $('#datasub').append(datahtml)
              }


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
                                            '<div class="col-md-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="ukuran">Ukuran</label>'+
                                                    '<input type="text" class="form-control" required id="ukuran" name="ukuran[]">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                                '<div class="form-group">'+
                                                    '<label for="jumlah">Jumlah</label>'+
                                                    '<input type="number" class="form-control"  required id="jumlah" name="jumlah[]" >'+
                                        '</div>'+
                            '</div>'+
                    '</div>'
                $('#datasub').append(datahtml)
            })

             $('#kode_transaksi').on('change', function () {
                    var id = $(this).find(':selected').val()

                    if(id != ''){
                        $.ajax({
                            url:"{{route('potong.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var bahan = data.bahan
                                var detail_potong = data.detail_potong
                                var detail = bahan.detail_sub.nama_kategori;
                                var subkategori = bahan.detail_sub.sub_kategori.nama_kategori;
                                var kategori = bahan.detail_sub.sub_kategori.kategori.nama_kategori;
                                $('#no_surat').val(data.no_surat)
                                $('#tanggal_potong').val(data.tanggal_cutting)
                                $('#estimasi_selesai_potong').val(data.tanggal_selesai)
                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(subkategori)
                                $('#detail_sub_kategori').val(detail)
                                $('#sku').val(bahan.sku)
                                $('#nama_produk').val(bahan.nama_bahan)
                                $('#jenis_kain').val(bahan.jenis_bahan)
                                $('#warna').val(bahan.warna)
                                $('#vendor_keluar').val(bahan.vendor)
                                $('#panjang_kain').val(bahan.panjang_bahan_diambil)
                                $('#hasil_cutting').val(data.hasil_cutting)
                                $('#konversi').val(data.konversi)

                                for (let index = 0; index < detail_potong.length; index++) {
                                    const element = detail_potong[index];
                                    generateUkuran(element.size, element.jumlah)

                                }
                            }

                        })
                    }
            })



     })
</script>
@endpush
