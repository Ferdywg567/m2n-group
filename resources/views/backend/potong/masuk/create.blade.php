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
            <h1 class="ml-2">Input Data | Potong</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @include('backend.include.alert')
                            <form action="{{route('potong.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="potong masuk">
                                <input type="hidden" name="id" id="idmasuk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <div id="kdbahanselectmasuk">
                                                <select class="form-control" id="kode_transaksi" name="kode_transaksi">
                                                    <option value="">Pilih Kode Transaksi</option>
                                                    @forelse ($bahan as $item)
                                                    <option value="{{$item->id}}">{{$item->kode_transaksi}}
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
                                            <input type="text" class="form-control" required id="no_surat"
                                                name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_potong">Tanggal Potong</label>
                                            <input type="date" class="form-control" required id="tanggal_potong"
                                                name="tanggal_potong">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="estimasi_selesai_potong">Estimasi Selesai Potong</label>
                                            <input type="date" class="form-control" required
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
                                            <label for="hasil_cutting">Hasil Cutting</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" required id="hasil_cutting"
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
                                            <input type="text" class="form-control" required readonly
                                                    id="konversi" name="konversi">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div id="datasub">
                                    <div class="row">
                                        <input type="hidden" name="nilai" id="nilai" value="1">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ukuran">Ukuran</label>
                                                <input type="text" class="form-control" required id="ukuran"
                                                    name="ukuran[]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="number" class="form-control"  required id="jumlah" name="jumlah[]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-block btntambah">Tambah Ukuran</button>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('potong.index')}}">Batal</a>

                                        <button type="submit" onclick="return submitbtn()" class="btn btn-primary btnmasuk btnsimpan">Simpan</button>

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
                            url:"{{route('bahan.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var detail = data.detail_sub.nama_kategori;
                                var subkategori = data.detail_sub.sub_kategori.nama_kategori;
                                var kategori = data.detail_sub.sub_kategori.kategori.nama_kategori;

                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(subkategori)
                                $('#detail_sub_kategori').val(detail)
                                $('#sku').val(data.sku)
                                $('#nama_produk').val(data.nama_bahan)
                                $('#jenis_kain').val(data.jenis_bahan)
                                $('#warna').val(data.warna)
                                $('#vendor_keluar').val(data.vendor)
                                $('#panjang_kain').val(data.panjang_bahan_diambil)
                                $('#hasil_cutting').prop('max',data.panjang_bahan_diambil)
                            }

                        })
                    }
            })



     })
</script>
@endpush
