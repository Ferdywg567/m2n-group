@extends('backend.master')

@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')

@section('content')

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('warehouse.rekapitulasi.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Rekapitulasi</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.rekapitulasi.store')}}" method="post">
                            @csrf

                            <div class="card-body">
                                @include('backend.include.alert')
                                <input type="hidden" name="detail_id" id="detail_id" value="">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <select class="form-control" id="kode_bahanselect" name="kode_bahan">
                                                <option value="">Pilih Kode Bahan</option>
                                                @forelse ($warehouse as $item)
                                                <option value="{{$item->id}}">
                                                    {{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}}
                                                    |
                                                    {{$item->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}
                                                </option>
                                                @empty

                                                @endforelse


                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" readonly required id="jenis_bahan"
                                                name="jenis_bahan">
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
                                            <label for="tanggal_masuk">Tanggal Barang Masuk </label>
                                            <input type="date" class="form-control" readonly required id="tanggal_masuk"
                                                name="tanggal_masuk">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_kirim">Tanggal Kirim Barang</label>
                                            <input type="date" class="form-control" required id="tanggal_kirim"
                                                name="tanggal_kirim">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_barang">Total Barang Dijual</label>
                                            <div class="input-group mb-2">

                                                <input type="number" class="form-control" readonly required
                                                    id="total_barang" name="total_barang">
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
                                                <input type="number" class="form-control" readonly required
                                                    id="harga_produk" name="harga_produk">
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

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="jumlahs">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetails">
                                            <input type="number" min="0" class="form-control" id="jumlahs"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="jumlahm">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                            <input type="number" min="0" class="form-control" id="jumlahm"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="jumlahl">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                            <input type="number" min="0" class="form-control" id="jumlahl"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranxl">
                                        <div class="form-group">
                                            <label for="jumlahxl">XL</label>
                                            <input type="hidden" name="dataukuran[]" value="XL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxl">
                                            <input type="number" min="0" class="form-control" id="jumlahxl"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranxxl">
                                        <div class="form-group">
                                            <label for="jumlahxxl">XXL</label>
                                            <input type="hidden" name="dataukuran[]" value="XXL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxxl">
                                            <input type="number" min="0" class="form-control" id="jumlahxxl"
                                                name="jumlah[]">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a type="button" class="btn btn-secondary"
                                            href="{{route('warehouse.rekapitulasi.index')}}">Batal</a>

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
              $('#kdbahanreadonly').hide()
              $('#idukuran').hide();
              $('#ukuran').hide();
              $('#tabelmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              $('#kode_bahanselect').select2()
              $('#kode_bahanselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')



            $('#kode_bahanselect').on('change', function () {
                    var id = $(this).find(':selected').val()

                    if(id != ''){
                        $.ajax({
                            url:"{{route('warehouse.rekapitulasi.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id,
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;

                                var bahan = data.finishing.rekapitulasi.cuci.jahit.potong.bahan
                                var detail_warehouse = data.detail_warehouse
                                $('#sku_keluar').val(bahan.sku)
                                $('#nama_bahan').val(bahan.nama_bahan)
                                $('#jenis_bahan').val(bahan.jenis_bahan)
                                $('#warna_baju_keluar').val(bahan.warna)
                                $('#tanggal_masuk').val(bahan.tanggal_masuk)

                                $('#harga_produk').val(data.harga_produk)
                                $('#ukuran').show()
                                $('#idukuran').show()
                                var total_barang = 0;
                                for (let index = 0; index < detail_warehouse.length; index++) {
                                    const element = detail_warehouse[index];
                                    total_barang += element.jumlah
                                    if(element.ukuran == 'S'){
                                        $('#iddetails').val(element.id)
                                        $('#jumlahs').val(element.jumlah)
                                        $('#jumlahs').prop('readonly',true)

                                    }else if(element.ukuran == 'M'){
                                        $('#iddetailm').val(element.id)
                                        $('#jumlahm').val(element.jumlah)
                                        $('#jumlahm').prop('readonly',true)
                                        $('#ukuranm').show()
                                        $('#ukurandirepairm').show()
                                         $('#ukurandibuangm').show()
                                    }else if(element.ukuran == 'L'){
                                        $('#iddetaill').val(element.id)
                                        $('#jumlahl').val(element.jumlah)
                                        $('#jumlahl').prop('readonly',true)
                                        $('#ukuranl').show()
                                        $('#ukurandirepairl').show()
                                        $('#ukurandibuangl').show()
                                    }else if(element.ukuran == 'XL'){
                                        $('#iddetailxl').val(element.id)
                                        $('#jumlahxl').val(element.jumlah)
                                        $('#jumlahxl').prop('readonly',true)
                                        $('#ukuranxl').show()
                                        $('#ukurandirepairxl').show()
                                        $('#ukurandibuangxl').show()
                                    }else if(element.ukuran == 'XXL'){
                                        $('#iddetailxxl').val(element.id)
                                        $('#jumlahxxl').val(element.jumlah)
                                        $('#jumlahxxl').prop('readonly',true)
                                        $('#ukuranxxl').show()
                                        $('#ukurandirepairxxl').show()
                                        $('#ukurandibuangxxl').show()
                                    }
                                }

                                $('#total_barang').val(total_barang)
                            }

                        })
                    }
            })


     })
</script>
@endpush
