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
            <h1 class="ml-2">Warehouse</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('warehouse.warehouse.store')}}" method="post">
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
                                                {{-- @forelse ($cuci as $item)
                                                    @forelse ($item->detail_cuci as $row)
                                                        <option value="{{$item->id}}" data-ukuran="{{$row->size}}">{{$item->jahit->potong->bahan->kode_bahan}} |
                                                            {{$item->jahit->potong->bahan->nama_bahan}} | {{$row->size}}
                                                        </option>
                                                    @empty

                                                    @endforelse

                                                @empty

                                                @endforelse --}}


                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sku">SKU</label>
                                            <input type="text" class="form-control" readonly required id="sku_keluar"
                                                name="sku" >
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_bahan">Jenis Bahan</label>
                                            <input type="text" class="form-control" readonly required
                                                id="jenis_bahan" name="jenis_bahan"
                                                >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_bahan">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required id="nama_bahan"
                                                name="nama_bahan" >
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ukuran_baju">Ukuran Baju</label>
                                            <input type="text" class="form-control" readonly required id="ukuran_baju"
                                                name="ukuran_baju" >
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="warna_baju">Warna Baju</label>
                                            <input type="text" class="form-control" readonly required
                                                id="warna_baju_keluar" name="warna_baju"
                                                >
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="text-dark font-weight-bold">Asal Barang</label>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="total_barang">Total Barang Siap QC</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly required
                                                    id="total_barang" name="total_barang">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">pcs</div>
                                                </div>
                                            </div>
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
                            url:"{{route('rekapitulasi.getdata')}}",
                            method:"GET",
                            data:{
                                'id':id,
                                'size':ukuran
                            }
                        }).done(function (response) {

                            if(response.status){
                                console.log(response);
                                var data = response.data;
                                var detail = data.detail_cuci[0]
                                var bahan = data.jahit.potong.bahan
                                $('#sku_keluar').val(bahan.sku)
                                $('#nama_bahan').val(bahan.nama_bahan)
                                $('#jenis_bahan').val(bahan.jenis_bahan)
                                $('#warna_baju_keluar').val(bahan.warna)
                                $('#tanggal_masuk').val(bahan.tanggal_masuk)
                                $('#tanggal_selesai_keluar').val(data.tanggal_selesai)
                                $('#ukuran_baju').val(ukuran)
                                $('#total_barang').val(detail.jumlah)
                                $('#detail_id').val(detail.id)
                                $('#panjang_kain_keluar').val(bahan.panjang_bahan)
                            }

                        })
                    }
            })


     })
</script>
@endpush
