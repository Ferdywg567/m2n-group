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

        .cssnav {
            margin-left: 10px;
        }
    </style>

    <div id="non-printable">
        <section class="section">
            <div class="section-header ">

                <h1 class="ml-2">Input Data | Transaksi</h1>
            </div>
            <div class="section-body">

                <form method="post" id="formDetail" action="{{ route('offline.transaksi.store') }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    @include('ecommerce.admin.include.alert')

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
                                                        <option value="{{ $item->id }}">{{ $item->kode_produk }} |
                                                            {{ $item->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="ukuran">Plih Ukuran</label>
                                                <select class="form-control" id="ukuran" name="ukuran">
                                                    <option value="0">Pilih Ukuran</option>

                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kode_sku">Kode Sku</label>
                                                <input type="text" class="form-control" readonly required id="kode_sku"
                                                    name="kode_sku" value="{{ old('kode_sku') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="warna">Warna</label>
                                                <input type="text" class="form-control" readonly required id="warna"
                                                    name="warna" value="{{ old('warna') }}">
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
                                                <input type="text" class="form-control" required readonly
                                                    id="sub_kategori" name="sub_kategori">
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
                                                    name="stok" value="{{ old('stok') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ukuran_read">Ukuran</label>
                                                <input type="text" class="form-control" readonly required
                                                    id="ukuran_read" name="ukuran_read" value="{{ old('ukuran_read') }}">
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

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="cetak">Cetak</label>
                                                <select class="form-control" id="cetak" name="cetak">
                                                    <option value="Push">Push & Pull Logo</option>
                                                    <option value="M2N">M2N Kids Logo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <h5>Detail Pelanggan</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama">Nama Pelanggan</label>
                                                <input type="text" class="form-control" required id="nama"
                                                    name="nama">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_hp">No. HP</label>
                                                <input type="text" class="form-control" required id="no_hp"
                                                    name="no_hp">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" class="form-control" required id="alamat"
                                                    name="alamat">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pembayaran">Pembayaran</label>
                                                <select class="form-control" id="pembayaran" name="pembayaran">
                                                    <option value="Tunai">Tunai</option>
                                                    <option value="Transfer">Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

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
                                                <input type="text" class="form-control" readonly required
                                                    id="kode_transaksi" name="kode_transaksi"
                                                    value="{{ $kode }}">
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-hover" id="tabelproduk">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Produk</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Ukuran</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Sub Total</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">

                                        </tbody>
                                    </table>


                                    <div class="row">
                                        <div class="col-md-8 float-left text-left">
                                            <div class="form-group mt-2" style="padding-left: 50px;">
                                                <h4>Total</h4>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" readonly required id="total_harga"
                                                name="total_harga" value="{{ $transaksi['total_harga'] }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 float-left text-left">
                                            <div class="form-group mt-2" style="padding-left: 50px;">
                                                <h4>Bayar</h4>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" required id="bayar"
                                                name="bayar" value="{{ old('bayar') }}">
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
                                                name="kembalian" value="{{ old('kembalian') }}">
                                        </div>
                                    </div>
                                    <div class="float-right mt-3">
                                        <button type="button" class="btn btn-primary btnsimpan">Simpan</button>
                                        <button type="button" class="btn btn-primary btnsimpancetak">Simpan &
                                            Cetak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>


    </div>

@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: 0,
            }, ],
            order: [
                [1, 'asc']
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
        });

        $(document).ready(function() {
            function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }
            $('#barang').select2()
            $('#produk').select2()
            $('#ukuran').select2()
            $('#promo').select2()
            $('#bayar').mask('000.000.000.000', {
                reverse: true
            });
            var table_detail = $('#tabelproduk').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('offline.transaksi.gettable') }}",
                columns: [{
                        data: 'urut',
                        name: 'urut'
                    },
                    {
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'ukuran',
                        name: 'ukuran'
                    },
                    {
                        data: 'qty',
                        name: 'qty'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $('td:eq(5)', nRow).html("Rp. " + convertToRupiah(aData["harga"]));
                    $('td:eq(6)', nRow).html("Rp. " + convertToRupiah(aData["subtotal"]));
                },
                createdRow: function(row, data, dataIndex) {
                    console.log(data)
                    $(row).find('td:eq(4)').addClass('updateqty');
                    $(row).find('td:eq(4)').attr('data-idbarang', data['kode']);
                    if (data['ukuran'] == 'S,M,L') {
                        var ukuran = 'seri';
                    } else {
                        var ukuran = data['ukuran'];
                    }
                    $(row).find('td:eq(4)').attr('data-ukuran', ukuran);
                    $.each($('td:eq(4)', row), function(colIndex) {

                        $(this).attr('contenteditable', 'true');
                    });
                }
            })

            table_detail.on('order.dt search.dt', function() {
                let i = 1;

                table_detail.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();

            $('#bayar').on('keyup', function() {
                var total_harga = $('#total_harga').val()
                total_harga = convertToAngka(total_harga);
                var bayar = convertToAngka($(this).val())
                var kembalian = bayar - total_harga;

                if (bayar > total_harga) {

                    $('#kembalian').val(convertToRupiah(kembalian))
                } else {
                    $('#kembalian').val(0)
                }


            })

            var total_harga = $('#total_harga').val()
            $('#total_harga').val(convertToRupiah(total_harga))

            $('#produk').on('change', function() {
                var id = $(this).find(':selected').val()
                $('#ukuran').empty()
                $('#ukuran').append('<option value="0">Pilih Ukuran</option>')
                if (id != '0') {

                    $.ajax({
                        url: "{{ route('offline.transaksi.getdetail') }}",
                        method: "GET",
                        data: {
                            id: id,
                            status: 'produk'
                        },
                        success: function(response) {
                            if (response.status) {
                                console.log(response);
                                var data = response.data;
                                if (response.seri) {
                                    $('#ukuran').append('<option value="seri">S,M,L</option>')
                                }
                                for (let index = 0; index < data.length; index++) {
                                    const element = data[index];
                                    console.log(element);
                                    $('#ukuran').append('<option value="' + element.ukuran +
                                        '">' + element.ukuran + '</option>')
                                }


                                // var data = response.data
                                // var bahan = data.warehouse.finishing.cuci.jahit.potong.bahan
                                // console.log(bahan);
                                // var detail_sub = bahan.detail_sub.nama_kategori;
                                // var sub_kategori = bahan.detail_sub.sub_kategori.nama_kategori;
                                // var kategori = bahan.detail_sub.sub_kategori.kategori.nama_kategori;
                                // var detail = data.detail_produk
                                // $('#kode_sku').val(bahan.sku)
                                // $('#warna').val(bahan.warna)
                                // $('#kategori').val(kategori)
                                // $('#sub_kategori').val(sub_kategori)
                                // $('#detail_sub_kategori').val(detail_sub)
                                // $('#stok').val(data.stok)
                                // $('#harga').val(convertToRupiah(data.harga))
                                // var ukuran = ""
                                // for (let index = 0; index < detail.length; index++) {
                                //     const element = detail[index];

                                //     ukuran += element.ukuran + ", ";
                                // }
                                // ukuran =  ukuran.replace(/,\s*$/, "");
                                // $('#ukuran').val(ukuran)
                                // $('#total_harga').val(convertToRupiah(response.total_harga))
                                // table_detail.ajax.reload();

                                // setTimeout(function () { $('#form_transaksi').trigger('reset') },2000)
                                // $('#produk').val('0').change()

                            }
                        }
                    })
                }

            })


            $('#ukuran').on('change', function() {
                var id = $('#produk').find(':selected').val()
                var ukuran = $('#ukuran').find(':selected').val()
                if (id != '0' && ukuran != '0') {
                    $.ajax({
                        url: "{{ route('offline.transaksi.getdetail') }}",
                        method: "GET",
                        data: {
                            id: id,
                            ukuran: ukuran,
                        },
                        success: function(response) {
                            if (response.status) {
                                console.log(response);
                                var data = response.data
                                var bahan = data.warehouse.finishing.cuci.jahit.potong.bahan
                                var detail_sub = bahan.detail_sub.nama_kategori;
                                var sub_kategori = bahan.detail_sub.sub_kategori.nama_kategori;
                                var kategori = bahan.detail_sub.sub_kategori.kategori
                                    .nama_kategori;
                                var detail = data.detail_produk
                                $('#kode_sku').val(bahan.sku)
                                $('#warna').val(bahan.warna)
                                $('#kategori').val(kategori)
                                $('#sub_kategori').val(sub_kategori)
                                $('#detail_sub_kategori').val(detail_sub)
                                $('#stok').val(data.stok)
                                $('#harga').val(convertToRupiah(response.harga))

                                $('#ukuran_read').val(response.ukuran)
                                $('#total_harga').val(convertToRupiah(response.total_harga))
                                table_detail.ajax.reload();

                                // setTimeout(function () { $('#form_transaksi').trigger('reset') },2000)
                                // $('#produk').val('0').change()

                            }
                        }
                    })
                }
            })

            function convertToAngka(rupiah) {
                return parseInt(rupiah.replace(/,.*|[^0-9]/g, ''), 10);
            }

            function convertToRupiah(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++) {
                    if (i % 3 == 0) {
                        rupiah += angkarev.substr(i, 3) + '.';
                    }
                }

                var res = rupiah.split('', rupiah.length - 1).reverse().join('');
                return res;
            }

            $('.btnsimpancetak').on('click', function() {
                var bayar = convertToAngka($('#bayar').val());
                var total_harga = convertToAngka($('#total_harga').val())
                var cetak = $('#cetak').find(':selected').val()

                var nama = $('#nama').val()
                var no_hp = $('#no_hp').val()
                var alamat = $('#alamat').val()


                if (nama == '' || no_hp == '' || alamat == '') {
                    swal("Detail pelanggan wajib diisi!");

                    return false;
                }

                $.ajax({
                    url: "{{ route('offline.transaksi.cek') }}",
                    method: "GET",
                    success: function(response) {
                        if (response.status) {
                            if (bayar >= total_harga) {
                                swal({
                                        text: "Apa anda yakin menyimpan data transaksi ini ?",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                    .then((willInsert) => {
                                        if (willInsert) {

                                            var form = $('#formDetail').serialize()
                                            ajax()
                                            $.ajax({
                                                url: "{{ route('offline.transaksi.store') }}",
                                                method: "POST",
                                                data: form,
                                                success: function(response) {
                                                    if (response.status) {
                                                        window.open(
                                                            "{{ url('admin/offline/transaksi/cetak/') }}/" +
                                                            response.data +
                                                            "/?cetak=" +
                                                            cetak)
                                                        // setTimeout(function () { window.location.reload(true) },1500)
                                                        $('#formDetail')
                                                            .trigger('reset')
                                                        table_detail.clear()
                                                            .draw();
                                                        $('#kode_transaksi')
                                                            .val(response
                                                                .kode_transaksi)
                                                        setTimeout(() => {
                                                            iziToast
                                                                .success({
                                                                    title: 'Yeay!',
                                                                    message: 'Transaksi berhasil disimpan!',
                                                                    position: 'topRight'
                                                                });
                                                        }, 500)
                                                    }
                                                }
                                            })

                                        }
                                    });
                            } else {
                                swal("Silahkan isi pembayaran yang sesuai!");
                            }

                        } else {
                            swal("Belum ada transaksi, silahkan pilih produk terlebih dahulu!");
                        }
                    }
                })


            })
            $('.btnsimpan').on('click', function() {
                var bayar = convertToAngka($('#bayar').val());
                var total_harga = convertToAngka($('#total_harga').val())
                var nama = $('#nama').val()
                var no_hp = $('#no_hp').val()
                var alamat = $('#alamat').val()


                if (nama == '' || no_hp == '' || alamat == '') {
                    swal("Detail pelanggan wajib diisi!");

                    return false;
                }

                $.ajax({
                    url: "{{ route('offline.transaksi.cek') }}",
                    method: "GET",
                    success: function(response) {
                        if (response.status) {
                            if (bayar >= total_harga) {
                                swal({
                                        text: "Apa anda yakin menyimpan data transaksi ini ?",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                    .then((willInsert) => {
                                        if (willInsert) {

                                            var form = $('#formDetail').serialize()
                                            ajax()
                                            $.ajax({
                                                url: "{{ route('offline.transaksi.store') }}",
                                                method: "POST",
                                                data: form,
                                                success: function(response) {
                                                    if (response.status) {

                                                        // setTimeout(function () { window.location.reload(true) },1500)
                                                        $('#formDetail')
                                                            .trigger('reset')
                                                        table_detail.clear()
                                                            .draw();
                                                        $('#kode_transaksi')
                                                            .val(response
                                                                .kode_transaksi)
                                                        setTimeout(() => {
                                                            iziToast
                                                                .success({
                                                                    title: 'Yeay!',
                                                                    message: 'Transaksi berhasil disimpan!',
                                                                    position: 'topRight'
                                                                });
                                                        }, 500)
                                                    }else{
                                                        swal(response.message);
                                                    }
                                                }
                                            })

                                        }
                                    });
                            } else {
                                swal("Silahkan isi pembayaran yang sesuai!");
                            }

                        } else {
                            swal("Belum ada transaksi, silahkan pilih produk terlebih dahulu!");
                        }
                    }
                })


            })
            $(document).on('blur change', '.updateqty', function() {
                var id_barang = $(this).data('idbarang');
                var qty = $(this).text()
                var ukuran = $(this).data('ukuran');
                ajax();
                swal({
                        text: "Apa anda yakin mengubah qty produk ?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willUpdate) => {
                        if (willUpdate) {
                            $.ajax({
                                url: "{{ route('offline.transaksi.update_detail_barang') }}",
                                method: "POST",
                                data: {
                                    'id_barang': id_barang,
                                    'qty': qty,
                                    'ukuran': ukuran
                                },
                                success: function(response) {
                                    if (response.status) {
                                        $('#total_harga').val(convertToRupiah(response
                                            .total_harga))
                                    } else {
                                        swal("Maaf stok tidak mencukupi!");
                                    }

                                    table_detail.ajax.reload();
                                }
                            })
                        } else {
                            table_detail.ajax.reload();
                        }
                    });

            });

            $(document).on('click', '.btnDelete', function() {
                var kode = $(this).data('kode')
                var ukuran = $(this).data('ukuran')
                swal({
                        title: "Apa anda yakin?",
                        text: "ketika dihapus, data tidak bisa dikembalikan!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href =
                                "{{ url('/admin/offline/transaksi/delete_transaksi/') }}/" + kode +
                                "/" + ukuran;
                        }
                    });
            })
        })
    </script>
@endpush
