@extends('ecommerce.offline.master')
@section('title', 'Transaksi')
@section('title-nav', 'Transaksi')
@section('transaksi', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .dropzone {
        border: 2px dashed #dedede;
        border-radius: 5px;
        background: #f5f5f5;
    }

    .dropzone i {
        font-size: 5rem;
    }

    .dropzone .dz-message {
        color: rgba(0, 0, 0, .54);
        font-weight: 500;
        font-size: initial;

    }
</style>

<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('offline.transaksi.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">Input Data | Transaksi</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('ecommerce.admin.include.alert')
                            <form id="form_transaksi" enctype="multipart/form-data">
                                @csrf
                                <div id="data-alert">

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="produk">Plih Produk</label>
                                            <select class="form-control" id="produk" name="produk">
                                                <option value="0">Pilih Produk</option>
                                                @forelse ($produk as $item)
                                                <option value="{{$item->id}}">{{$item->kode_produk}}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_sku">Kode Sku</label>
                                            <input type="text" class="form-control" readonly required id="kode_sku"
                                                name="kode_sku" value="{{old('kode_sku')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="warna">Warna</label>
                                            <input type="text" class="form-control" readonly required id="warna"
                                                name="warna" value="{{old('warna')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
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
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="detail_sub_kategori">Detail Sub Kategori</label>

                                            <input type="text" class="form-control" required readonly
                                                id="detail_sub_kategori" name="detail_sub_kategori">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="text" class="form-control" readonly required id="stok"
                                                name="stok" value="{{old('stok')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ukuran">Ukuran</label>
                                            <input type="text" class="form-control" readonly required id="ukuran"
                                                name="ukuran" value="{{old('ukuran')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="harga">Harga / Seri</label>
                                            <input type="text" class="form-control" required readonly id="harga"
                                                name="harga">
                                        </div>
                                    </div>


                                </div>




                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="text-dark"><i class="fas fa-list pr-2"></i> Detail Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="kode_transaksi">Kode Transaksi</label>
                                        <input type="text" class="form-control" readonly required id="kode_transaksi"
                                            name="kode_transaksi" value="{{$kode}}">
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover" id="tabelproduk">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Sub Total</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">

                                </tbody>
                            </table>
                            <form method="post" id="formDetail" action="{{route('offline.transaksi.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 float-left text-left">
                                        <div class="form-group mt-2" style="padding-left: 50px;">
                                            <h4>Total</h4>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" readonly required id="total_harga"
                                            name="total_harga" value="{{$transaksi['total_harga']}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 float-left text-left">
                                        <div class="form-group mt-2" style="padding-left: 50px;">
                                            <h4>Bayar</h4>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" required id="bayar" name="bayar"
                                            value="{{old('bayar')}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 float-left text-left">
                                        <div class="form-group mt-2" style="padding-left: 50px;">
                                            <h4>Kembalian</h4>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" readonly required id="kembalian"
                                            name="kembalian" value="{{old('kembalian')}}">
                                    </div>
                                </div>
                                <div class="float-right mt-3">
                                    <button type="button" class="btn btn-primary btnsimpan">Simpan Transaksi</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script>
    $(document).ready(function () {
             function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              }
            $('#barang').select2()
            $('#produk').select2()
            $('#promo').select2()
            $('#bayar').mask('000.000.000.000', {
                reverse: true
            });
            var table_detail = $('#tabelproduk').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('offline.transaksi.gettable') }}",
                    columns: [
                        {data: 'urut', name: 'urut'},
                        {data: 'kode', name: 'kode'},
                        {data: 'nama', name: 'nama'},
                        {data: 'qty', name: 'qty'},
                        {data: 'harga', name: 'harga'},
                        {data: 'subtotal', name: 'subtotal'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                    },
                    fnRowCallback:function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
                        $('td:eq(4)', nRow).html("Rp. "+convertToRupiah(aData["harga"]));
                        $('td:eq(5)', nRow).html("Rp. "+convertToRupiah(aData["subtotal"]));
                    },
              })

              $('#bayar').on('keyup',function () {
                    var total_harga = $('#total_harga').val()
                    total_harga = convertToAngka(total_harga);
                    var bayar = convertToAngka($(this).val())
                    var kembalian = bayar - total_harga;

                    if(bayar > total_harga){

                        $('#kembalian').val(convertToRupiah(kembalian))
                    }else{
                        $('#kembalian').val(0)
                    }


               })

               var total_harga = $('#total_harga').val()
               $('#total_harga').val(convertToRupiah(total_harga))

            $('#produk').on('change', function () {
                var id = $(this).find(':selected').val()
                if(id != '0'){
                    $.ajax({
                    url:"{{route('offline.transaksi.getdetail')}}",
                    method:"GET",
                    data:{
                        id:id
                    },success:function(response){
                        if(response.status){
                                console.log(response);
                                var data = response.data
                                var bahan = data.warehouse.finishing.cuci.jahit.potong.bahan
                                console.log(bahan);
                                var detail_sub = bahan.detail_sub.nama_kategori;
                                var sub_kategori = bahan.detail_sub.sub_kategori.nama_kategori;
                                var kategori = bahan.detail_sub.sub_kategori.kategori.nama_kategori;
                                var detail = data.detail_produk
                                $('#kode_sku').val(bahan.sku)
                                $('#warna').val(bahan.warna)
                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(sub_kategori)
                                $('#detail_sub_kategori').val(detail_sub)
                                $('#stok').val(data.stok)
                                $('#harga').val(convertToRupiah(data.harga))
                                var ukuran = ""
                                for (let index = 0; index < detail.length; index++) {
                                    const element = detail[index];

                                    ukuran += element.ukuran + ", ";
                                }
                                ukuran =  ukuran.replace(/,\s*$/, "");
                                $('#ukuran').val(ukuran)
                                $('#total_harga').val(convertToRupiah(response.total_harga))
                                table_detail.ajax.reload();

                                setTimeout(function () { $('#form_transaksi').trigger('reset') },2000)
                                $('#produk').val('0').change()

                        }
                    }
                })
                }

             })
             function convertToAngka(rupiah)
            {
                return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
            }
             function convertToRupiah(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++) {
                    if (i%3 == 0) {
                    rupiah += angkarev.substr(i,3)+'.';
                    }
                }

                var res = rupiah.split('',rupiah.length-1).reverse().join('');
                return res;
            }

            $('.btnsimpan').on('click', function () {
                var bayar = convertToAngka($('#bayar').val());
                var total_harga = convertToAngka($('#total_harga').val())


                    $.ajax({
                        url:"{{route('offline.transaksi.cek')}}",
                        method:"GET",
                        success:function(response){
                            if(response.status){
                                if(bayar >= total_harga){
                                    swal({
                                        text: "Apa anda yakin menyimpan data transaksi ini ?",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                        })
                                        .then((willInsert) => {
                                        if (willInsert) {
                                            // swal("Poof! Your imaginary file has been deleted!", {
                                            // icon: "success",
                                            // });
                                            $('#formDetail').submit()
                                        }
                                    });
                                }else{
                                    swal("Silahkan isi pembayaran yang sesuai!");
                                }

                            }else{
                                swal("Belum ada transaksi, silahkan pilih produk terlebih dahulu!");
                            }
                        }
                    })


            })

            $(document).on('click','.btnDelete', function () {
                    var kode = $(this).data('kode')

                swal({
                    title: "Apa anda yakin?",
                    text: "ketika dihapus, data tidak bisa dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href="{{url('/admin/offline/transaksi/delete_transaksi/')}}/"+kode;
                        }
                    });
            })
     })
</script>
@endpush
