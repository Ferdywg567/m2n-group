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
            <h1 class="ml-2">Edit Data | Keluar</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @include('backend.include.alert')
                            <form action="{{route('potong.update',[$potong->id])}}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="potong keluar">
                                <input type="hidden" name="id" id="idkeluar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_bahan">Kode Bahan</label>

                                            <div id="kdbahankeluar">
                                                <input type="text" class="form-control"
                                                    value="{{$potong->bahan->kode_bahan}}" readonly
                                                    id="kdbahanreadkeluar" name="kdbahanreadkeluar">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_surat_keluar">Nomor Surat Jalan</label>
                                            <input type="text" class="form-control" value="{{$potong->no_surat}}"
                                                required id="no_surat_keluar" name="no_surat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_selesai_keluar">Tanggal Selesai</label>
                                            <input type="date" class="form-control" value="{{$potong->tanggal_selesai}}"
                                                readonly required id="tanggal_selesai_keluar" name="tanggal_selesai">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sku">Kode SKU</label>
                                            <input type="text" class="form-control" readonly required
                                                value="{{$potong->bahan->sku}}" id="sku_keluar" name="sku">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="jenis_kain">Jenis Kain</label>
                                            <input type="text" class="form-control" readonly
                                                value="{{$potong->bahan->skus->jenis_bahan}}" required id="jenis_kain_keluar"
                                                name="jenis_kain">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" class="form-control" readonly required
                                                value="{{$potong->bahan->skus->nama_produk}}" id="nama_produk_keluar"
                                                name="nama_produk">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="panjang_kain">Panjang Bahan</label>
                                            <div class="input-group mb-2">
                                                <input type="number" class="form-control" readonly
                                                    value="{{$potong->bahan->panjang_bahan}}" required
                                                    id="panjang_kain_keluar" name="panjang_kain">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">yard</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly required
                                                value="{{$potong->bahan->skus->warna}}" id="warna_keluar" name="warna">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="hasil_cutting">Hasil Cutting</label>
                                            <input type="number" class="form-control" required
                                                value="{{$potong->hasil_cutting}}" id="hasil_cutting"
                                                name="hasil_cutting">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="konversi">Konversi Lusin</label>
                                            <input type="text" readonly class="form-control"
                                                value="{{$potong->konversi}}" required id="konversi"
                                                name="konversi">
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="margin-bottom: -30px">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">


                                    @forelse ($potong->detail_potong as $item)
                                    @if ($item->size == 'S')
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ukuran">S</label>
                                            <input type="hidden" name="dataukuran[]" value="S">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}" id="iddetails">
                                            <input type="number" min="0" value="{{$item->jumlah}}" class="form-control"
                                                required id="jumlahs" name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->size == 'M')
                                    <div class="col-md-2" id="ukuranm">
                                        <div class="form-group">
                                            <label for="ukuran">M</label>
                                            <input type="hidden" name="dataukuran[]" value="M">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}" id="iddetailm">
                                            <input type="number" min="0"  value="{{$item->jumlah}}" class="form-control" required id="jumlahm"
                                                name="jumlah[]">
                                        </div>
                                    </div>
                                    @elseif($item->size == 'L')
                                    <div class="col-md-2" id="ukuranl">
                                        <div class="form-group">
                                            <label for="ukuran">L</label>
                                            <input type="hidden" name="dataukuran[]" value="L">
                                            <input type="hidden" name="iddetailukuran[]" value="{{$item->id}}" id="iddetaill">
                                            <input type="number" min="0" value="{{$item->jumlah}}" class="form-control" required id="jumlahl"
                                                name="jumlah[]">
                                        </div>
                                    </div>

                                    @endif
                                    @empty

                                    @endforelse
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tanggal_keluar">Tanggal Keluar</label>
                                            <input type="date" class="form-control" value="{{$potong->tanggal_keluar}}"
                                                required id="tanggal_keluar" name="tanggal_keluar">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
             function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              }

            //   $('#ukuranm').hide()
            //   $('#ukuranl').hide()
            //   $('#ukuranxl').hide()
            //   $('#ukuranxxl').hide()




            //   $(document).on('click','#btnsize', function(){
            //     var ukuranm = $('#ukuranm').is(':visible')
            //     var ukuranl = $('#ukuranl').is(':visible')
            //     var ukuranxl = $('#ukuranxl').is(':visible')
            //     var ukuranxxl = $('#ukuranxxl').is(':visible')

            //     if(!ukuranm){
            //         $('#ukuranm').show()
            //         $('#datahapus').show()
            //         return false;
            //     }else if(!ukuranl){
            //         $('#ukuranl').show()
            //         return false;
            //     }else if(!ukuranxl){
            //         $('#ukuranxl').show()
            //         return false;
            //     }else if(!ukuranxxl){
            //         $('#ukuranxxl').show()
            //         return false;
            //     }
            // })

            // $(document).on('click','#btnhapus', function(){
            //     var ukuranm = $('#ukuranm').is(':visible')
            //     var ukuranl = $('#ukuranl').is(':visible')
            //     var ukuranxl = $('#ukuranxl').is(':visible')
            //     var ukuranxxl = $('#ukuranxxl').is(':visible')

            //     if(ukuranxxl){
            //         $('#ukuranxxl').hide()
            //         $('#jumlahxxl').val('')
            //         return false;
            //     }else if(ukuranxl){
            //         $('#ukuranxl').hide()
            //         $('#jumlahxl').val('')
            //         return false;
            //     }else if(ukuranl){
            //         $('#ukuranl').hide()
            //         $('#jumlahl').val('')
            //         return false;
            //     }else if(ukuranm){
            //         $('#ukuranm').hide()
            //         $('#jumlahm').val('')
            //         $('#datahapus').hide()
            //         return false;
            //     }
            // })


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
