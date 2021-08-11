@extends('backend.master')

@section('title', 'Warehouse')

@section('warehouse', 'class=active')

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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>
                                            <select class="form-control" id="kode_bahanselect" name="kode_bahan">
                                                <option value="">Pilih Kode Bahan</option>
                                                @forelse ($kirim as $item)
                                                <option value="{{$item->id}}">
                                                    {{$item->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan}} |
                                                    {{$item->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan}}
                                                </option>
                                                @empty

                                                @endforelse

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku"
                                                name="sku">
                                        </div>

                                    </div>
                                    <div class="col-md-4">
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
                                            <label for="ukuran">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetails">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahs" name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailm">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahm" name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetaill">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahl" name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranxl">
                                        <div class="form-group">
                                            <label for="ukuran">XL</label>
                                            <input type="hidden" name="dataukuran[]" value="XL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxl">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahxl" name="jumlah[]">
                                        </div>
                                    </div>
                                    <div class="col-md-2" id="ukuranxxl">
                                        <div class="form-group">
                                            <label for="ukuran">XXL</label>
                                            <input type="hidden" name="dataukuran[]" value="XXL">
                                            <input type="hidden" name="iddetailukuran[]" id="iddetailxxl">
                                            <input type="number" min="0" class="form-control" readonly required
                                                id="jumlahxxl" name="jumlah[]">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
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
              $('#kode_bahanselect').select2()
              $('#kode_bahanselectkeluar').select2()
              $('.btnmasuk').prop('id','btnsimpanmasuk')



            $('#kode_bahanselect').on('change', function () {
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

                                var data = response.data;
                                var total_barang = data.rekapitulasi.total_barang
                                var bahan = data.rekapitulasi.cuci.jahit.potong.bahan

                                var detail_finish = data.detail_finish
                                var finish_retur = data.finish_retur
                                var finish_dibuang = data.finish_dibuang
                                $('#sku').val(bahan.sku)
                                $('#nama_bahan').val(bahan.nama_bahan)
                                $('#jenis_bahan').val(bahan.jenis_bahan)
                                $('#warna_baju').val(bahan.warna)
                                $('#siap_jual').val(data.barang_lolos_qc)

                                $('#ukuran').show()
                                $('#idukuran').show()
                                for (let index = 0; index < detail_finish.length; index++) {
                                    const element = detail_finish[index];
                                    const retur = finish_retur[index];
                                    const dibuang = finish_dibuang[index];
                                    if(element.ukuran == 'S'){
                                        $('#iddetails').val(element.id)
                                        $('#jumlahs').val(element.jumlah)
                                        $('#jumlahdireturs').val(retur.jumlah)
                                        $('#jumlahdibuangs').val(dibuang.jumlah)
                                        $('#jumlahs').prop('readonly',true)

                                    }else if(element.ukuran == 'M'){
                                        $('#iddetailm').val(element.id)
                                        $('#jumlahm').val(element.jumlah)
                                        $('#jumlahdireturm').val(retur.jumlah)
                                        $('#jumlahdibuangm').val(dibuang.jumlah)
                                        $('#jumlahm').prop('readonly',true)
                                        $('#ukuranm').show()
                                        $('#ukurandireturm').show()
                                         $('#ukurandibuangm').show()
                                    }else if(element.ukuran == 'L'){
                                        $('#iddetaill').val(element.id)
                                        $('#jumlahl').val(element.jumlah)
                                        $('#jumlahdireturl').val(retur.jumlah)
                                        $('#jumlahdibuangm').val(dibuang.jumlah)
                                        $('#jumlahl').prop('readonly',true)
                                        $('#ukuranl').show()
                                        $('#ukurandireturl').show()
                                        $('#ukurandibuangl').show()
                                    }else if(element.ukuran == 'XL'){
                                        $('#iddetailxl').val(element.id)
                                        $('#jumlahxl').val(element.jumlah)
                                        $('#jumlahdireturxl').val(retur.jumlah)
                                        $('#jumlahdibuangxl').val(dibuang.jumlah)
                                        $('#jumlahxl').prop('readonly',true)
                                        $('#ukuranxl').show()
                                        $('#ukurandireturxl').show()
                                        $('#ukurandibuangxl').show()
                                    }else if(element.ukuran == 'XXL'){
                                        $('#iddetailxxl').val(element.id)
                                        $('#jumlahxxl').val(element.jumlah)
                                        $('#jumlahdireturxxl').val(retur.jumlah)
                                        $('#jumlahdibuangxxl').val(dibuang.jumlah)
                                        $('#jumlahxxl').prop('readonly',true)
                                        $('#ukuranxxl').show()
                                        $('#ukurandireturxxl').show()
                                        $('#ukurandibuangxxl').show()
                                    }
                                }
                            }

                        })
                    }
            })


     })
</script>
@endpush
