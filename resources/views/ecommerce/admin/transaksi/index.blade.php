@extends('ecommerce.admin.master')
@section('title', 'Transaksi')
@section('title-nav', 'Transaksi')
@section('transaksi', 'class=active-sidebar')
@section('content')
<style>
    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;
        /* width: 10% !important; */
    }

    .left {
        text-align: left;
    }

</style>
<div id="non-printable">
    <section class="section mt-4">

        <div class="section-body mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            <div>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-bahanmasuk-tab" data-toggle="tab"
                                            href="#nav-bahanmasuk" role="tab" aria-controls="nav-bahanmasuk"
                                            aria-selected="true">Belum dibayar</a>
                                        <a class="nav-item nav-link " id="nav-stokbahan-tab" data-toggle="tab"
                                            href="#nav-stokbahan" role="tab" aria-controls="nav-stokbahan"
                                            aria-selected="true">Belum Dikirim</a>
                                        <a class="nav-item nav-link" id="nav-keluar-tab" data-toggle="tab"
                                            href="#nav-keluar" role="tab" aria-controls="nav-keluar"
                                            aria-selected="false">Dikirim</a>
                                        <a class="nav-item nav-link" id="nav-selesai-tab" data-toggle="tab"
                                            href="#nav-selesai" role="tab" aria-controls="nav-selesai"
                                            aria-selected="false">Selesai</a>
                                    </div>
                                </nav>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-bahanmasuk" role="tabpanel"
                                    aria-labelledby="nav-bahanmasuk-tab">
                                    <table class="table table-hover" id="tabelbahanmasuk">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Transaksi</th>
                                                <th scope="col">Kode Produk</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Status Bayar</th>

                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @forelse ($belumbayar as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->kode_transaksi}}</td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->produk->kode_produk}}</li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->produk->nama_produk}}</li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->jumlah}} seri</li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->produk->warehouse->finishing->cuci->jahit->potong->bahan->sku}}
                                                        </li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>@rupiah($item->total_harga)</td>

                                                <td><span
                                                        class="badge badge-warning text-dark">{{strtoupper($item->status_bayar)}}</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown dropleft">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center"
                                                            aria-labelledby="dropdownMenuButton">
                                                            @if ($item->status_bayar == 'sudah di upload')
                                                            <a class="dropdown-item" target="blank"
                                                                href="{{asset('uploads/images/bukti_bayar/'.$item->bukti_bayar)}}"><i
                                                                    class="ri-eye-line"></i>
                                                                Cek Bukti Bayar</a>
                                                            <a class="dropdown-item konfirmasi-bayar"
                                                                data-id="{{$item->id}}" href="#"><i
                                                                    class="ri-check-double-line"></i>
                                                                Konfirmasi Bayar</a>
                                                            @endif


                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty

                                            @endforelse

                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade show" id="nav-stokbahan" role="tabpanel"
                                    aria-labelledby="nav-stokbahan-tab">
                                    <table class="table table-hover" id="tabelstokbahan">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Transaksi</th>
                                                <th scope="col">Kode Produk</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">

                                            @forelse ($sudahbayar as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->kode_transaksi}}</td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->produk->kode_produk}}</li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->produk->nama_produk}}</li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->jumlah}} seri</li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->produk->warehouse->finishing->cuci->jahit->potong->bahan->sku}}
                                                        </li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>@rupiah($item->total_harga)</td>
                                                <td><span class="badge badge-warning text-dark">KONFIRMASI KIRIM</span>
                                                </td>


                                                <td>
                                                    <div class="dropdown dropleft">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item konfirmasi-kirim"
                                                                data-id="{{$item->id}}" href="#"><i
                                                                    class="ri-check-double-line"></i>
                                                                Konfirmasi Kirim</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="nav-keluar" role="tabpanel"
                                    aria-labelledby="nav-keluar-tab">
                                    <table class="table table-hover" id="tabelbahankeluar">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Transaksi</th>
                                                <th scope="col">Kode Produk</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">SKU</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="">
                                            @forelse ($dikirim as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->kode_transaksi}}</td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->produk->kode_produk}}</li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->produk->nama_produk}}</li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->jumlah}} seri</li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled">
                                                        @forelse ($item->detail_transaksi as $row)
                                                        <li>{{$row->produk->warehouse->finishing->cuci->jahit->potong->bahan->sku}}
                                                        </li>
                                                        @empty

                                                        @endforelse
                                                    </ul>
                                                </td>
                                                <td>@rupiah($item->total_harga)</td>
                                                <td><span class="badge badge-warning text-dark">DIKIRIM</span></td>
                                                <td>
                                                    {{-- <div class="dropdown dropleft">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item konfirmasi-kirim"
                                                                data-id="{{$item->id}}" href="#"><i
                                                        class="ri-check-double-line"></i>
                                                    Konfirmasi Kirim</a>
                                </div>
                            </div> --}}
                            </td>
                            </tr>
                            @empty

                            @endforelse
                            </tbody>
                            </table>

                        </div>
                        <div class="tab-pane fade" id="nav-selesai" role="tabpanel" aria-labelledby="nav-selesai-tab">
                            <table class="table table-hover" id="tabelbahanselesai">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Transaksi</th>
                                        <th scope="col">Kode Produk</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($selesai as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->kode_transaksi}}</td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @forelse ($item->detail_transaksi as $row)
                                                <li>{{$row->produk->kode_produk}}</li>
                                                @empty

                                                @endforelse
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @forelse ($item->detail_transaksi as $row)
                                                <li>{{$row->produk->nama_produk}}</li>
                                                @empty

                                                @endforelse
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @forelse ($item->detail_transaksi as $row)
                                                <li>{{$row->jumlah}} seri</li>
                                                @empty

                                                @endforelse
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @forelse ($item->detail_transaksi as $row)
                                                <li>{{$row->produk->warehouse->finishing->cuci->jahit->potong->bahan->sku}}
                                                </li>
                                                @empty

                                                @endforelse
                                            </ul>
                                        </td>
                                        <td>@rupiah($item->total_harga)</td>
                                        @if ($item->status == 'telah tiba')
                                        <td><span class="badge badge-success text-dark">TELAH TIBA</span></td>
                                        @else
                                        <td><span class="badge badge-warning text-dark">DIBATALKAN</span></td>
                                        @endif

                                        <td>
                                            {{-- <div class="dropdown dropleft">
                                                        <a class="" href="#" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu text-center"
                                                            aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item konfirmasi-kirim"
                                                                data-id="{{$item->id}}" href="#"><i
                                                class="ri-check-double-line"></i>
                                            Konfirmasi Kirim</a>
                        </div>
                    </div> --}}
                    </td>
                    </tr>
                    @empty

                    @endforelse
                    </tbody>
                    </table>

                </div>
            </div>

        </div>
</div>
</div>
</div>
</div>
</section>
</div>
<div class="modal fade" id="modalKirim" tabindex="-1" role="dialog" aria-labelledby="modalKirimLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKirimLabel">Konfirmasi Kirim</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formResi">
                    <div id="data-alert">

                    </div>
                    <input type="hidden" name="status" value="konfirmasi kirim">
                    <input type="hidden" name="id" id="id_transaksi_resi">
                    <div class="form-group">
                        <label for="nomor_resi">Nomor Resi</label>
                        <input type="text" class="form-control" id="nomor_resi" name="nomor_resi">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btnresi">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="modalBayarLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBayarLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formBayar">
                    <div id="data-alert-bayar">
                    </div>
                    <input type="hidden" name="status" value="konfirmasi bayar">
                    <input type="hidden" name="id" id="id_transaksi_bayar">
                    <div class="form-group">
                        <label for="status_bayar">Status Pembayaran</label>
                        <select class="form-control" id="status_bayar" name="status_bayar">
                            <option value="sudah dibayar">Sudah Dibayar</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary btnbayar">Update</button>
            </div>
        </div>
    </div>
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

        $('#nav-bahanmasuk-tab').css('background-color', 'black')
        $('#nav-bahanmasuk-tab').css('color', 'white')
        $('#nav-keluar-tab').css('background-color', '')
        $('#nav-keluar-tab').css('color', 'black')
        $('#nav-stokbahan-tab').css('background-color', '')
        $('#nav-stokbahan-tab').css('color', 'black')
        $('#nav-selesai-tab').css('background-color', '')
        $('#nav-selesai-tab').css('color', 'black')
        $('#nav-bahanmasuk-tab').click(function () {
            $(this).css('background-color', 'black')
            $(this).css('color', 'white')
            $('#nav-keluar-tab').css('background-color', '')
            $('#nav-keluar-tab').css('color', 'black')
            $('#nav-stokbahan-tab').css('background-color', '')
            $('#nav-stokbahan-tab').css('color', 'black')
            $('#nav-selesai-tab').css('background-color', '')
            $('#nav-selesai-tab').css('color', 'black')
        })

        $('#nav-stokbahan-tab').click(function () {
            $(this).css('background-color', 'black')
            $(this).css('color', 'white')
            $('#nav-keluar-tab').css('background-color', '')
            $('#nav-keluar-tab').css('color', 'black')
            $('#nav-bahanmasuk-tab').css('background-color', '')
            $('#nav-bahanmasuk-tab').css('color', 'black')
            $('#nav-selesai-tab').css('background-color', '')
            $('#nav-selesai-tab').css('color', 'black')
        })

        $('#nav-keluar-tab').click(function () {
            $('#nav-bahanmasuk-tab').css('background-color', '')
            $('#nav-bahanmasuk-tab').css('color', 'black')
            $('#nav-stokbahan-tab').css('background-color', '')
            $('#nav-stokbahan-tab').css('color', 'black')
            $('#nav-selesai-tab').css('background-color', '')
            $('#nav-selesai-tab').css('color', 'black')
            $(this).css('color', 'white')
            $(this).css('background-color', 'black')
        })

        $('#nav-selesai-tab').click(function () {
            $('#nav-bahanmasuk-tab').css('background-color', '')
            $('#nav-bahanmasuk-tab').css('color', 'black')
            $('#nav-stokbahan-tab').css('background-color', '')
            $('#nav-stokbahan-tab').css('color', 'black')
            $('#nav-keluar-tab').css('background-color', '')
            $('#nav-keluar-tab').css('color', 'black')
            $(this).css('color', 'white')
            $(this).css('background-color', 'black')
        })

        $('#tabelbahanmasuk').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
        })
        $('#tabelstokbahan').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
        })
        $('#tabelbahankeluar').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
        })
        $('#tabelbahanselesai').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
            },
        })
        $('#kode_bahanselect').select2()


        $(document).on('click', '.btnbayar', function () {
            var form = $('#formBayar').serialize()
            ajax()
            $.ajax({
                url: "{{route('ecommerce.transaksi.store')}}",
                method: "POST",
                data: form,
                success: function (response) {
                    if (response.status) {
                        setTimeout(function () {
                            location.reload(true)
                        }, 1000)
                    }
                    $('#data-alert-bayar').html(response.data)
                }
            })

        })
        $(document).on('click', '.konfirmasi-bayar', function () {
            var id = $(this).data('id')
            $('#id_transaksi_bayar').val(id)
            $('#modalBayar').modal('show')
            $('#data-alert-bayar').empty()
        })


        $(document).on('click', '.konfirmasi-kirim', function () {
            var id = $(this).data('id')
            $('#id_transaksi_resi').val(id)
            $('#modalKirim').modal('show')
            $('#data-alert').empty()
        })


        $(document).on('click', '.btnresi', function () {
            var form = $('#formResi').serialize()
            ajax()
            $.ajax({
                url: "{{route('ecommerce.transaksi.store')}}",
                method: "POST",
                data: form,
                success: function (response) {
                    if (response.status) {
                        setTimeout(function () {
                            location.reload(true)
                        }, 1500)
                    }
                    $('#data-alert').html(response.data)
                }
            })

        })


    })

</script>
@endpush
