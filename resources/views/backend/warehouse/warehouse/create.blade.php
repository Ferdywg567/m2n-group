@extends('backend.master')
@section('title', 'Gudang')
@section('title-nav', 'Gudang')
@section('warehouse', 'class=active-sidebar')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('warehouse.warehouse.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Warehouse</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.warehouse.store')}}" method="post">
                            @csrf

                            <div class="card-body">
                                @include('backend.include.alert')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_transaksi">Kode Transaksi</label>
                                            <select class="form-control" id="kode_transaksiselect"
                                                name="kode_transaksi">
                                                <option value="">Pilih Kode Transaksi</option>
                                                @forelse ($kirim as $item)
                                                <option value="{{$item->id}}">
                                                    {{$item->cuci->jahit->potong->bahan->kode_transaksi}}

                                                </option>
                                                @empty

                                                @endforelse

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" readonly required id="no_surat"
                                                name="no_surat">
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" readonly required id="jenis_bahan"
                                                name="jenis_bahan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                name="sku">
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna Baju</label>
                                            <input type="text" class="form-control" readonly required
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
                                                    name="harga_produk">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">/pcs</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="ukuran-utama">



                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('rekapitulasi.index')}}">Batal</a>

                                        <button type="submit" class="btn btn-primary">Simpan</button>

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
              $('#dataalert').hide()
              $('#kdbahanreadonly').hide()
              $('#ukuranm').hide()
              $('#ukuran').hide()
              $('#idukuran').hide()
              $('#ukuranl').hide()
              $('#ukuranxl').hide()
              $('#ukuranxxl').hide()
              $('#ukurandirepairm').hide()
              $('#ukurandirepairl').hide()
              $('#ukurandirepairxl').hide()
              $('#ukurandirepairxxl').hide()
              $('#ukurandibuangm').hide()
              $('#ukurandibuangl').hide()
              $('#ukurandibuangxl').hide()
              $('#ukurandibuangxxl').hide()
              $('#iddatavendor').hide()
              $('#idhargavendor').hide()
              $('#datavendor').hide()
              $('#kdbahanselectmasuk').show()
              $('#kdbahanmasuk').hide()
              $('#kdbahanselectkeluar').show()
              $('#kdbahankeluar').hide()
              $('.btnkeluar').prop('id','btnsimpankeluar')
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_transaksiselect').select2()
              $('#kode_transaksiselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')



            $('#kode_transaksiselect').on('change', function () {
                    var id = $(this).find(':selected').val()
                    var ukuran = $(this).find(':selected').data('ukuran')
                    if(id != ''){
                        $.ajax({
                            url:"{{route('warehouse.finishing.getdatafinish')}}",
                            method:"GET",
                            data:{
                                'id':id
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var bahan = data.cuci.jahit.potong.bahan
                                var cuci = data.cuci
                                var detail_finish = data.detail_finish
                                var finish_retur = data.finish_retur
                                var finish_dibuang = data.finish_dibuang
                                $('#sku').val(bahan.sku)
                                $('#no_surat').val(data.no_surat)
                                $('#nama_bahan').val(bahan.nama_bahan)
                                $('#jenis_bahan').val(bahan.jenis_bahan)
                                $('#warna_baju_keluar').val(bahan.warna)
                                $('#siap_jual').val(data.barang_lolos_qc)


                                var content="";
                                content += ' <label for="ukuran" class="text-dark">Ukuran </label>'
                                detail_finish.forEach((result, i) => {
                                    if(i == 0){
                                        content+= '<div class="row">'
                                    }

                                    content += '<div class="col-md-2">'+
                                    '<input type="hidden" name="dataukuran[]" value="'+result.ukuran+'">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">'+result.ukuran+'</div>'+
                                        '</div>'+
                                        '<input type="number" class="form-control" required readonly id="jumlah" name="jumlah[]" value="'+result.jumlah+'" >'+
                                    '</div>'+
                                   '</div>';
                                    if(i!=0 && i%6 == 0){

                                        // add end of row ,and start new row on every 5 elements
                                        content += '</div><div class="row">'
                                    }
                                });
                                // $('#title-ukuran').show()
                                $('#ukuran-utama').html(content)

                            }

                        })
                    }
            })


     })
</script>
@endpush
