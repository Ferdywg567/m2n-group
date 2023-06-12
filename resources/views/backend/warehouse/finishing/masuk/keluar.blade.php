@extends('backend.master')

@section('title', 'Finishing')
@section('title-nav', 'Sortir')
@section('finishing', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
    <style>
        textarea {
            width: 300px;
            height: 170px !important;
        }

        .form-control::placeholder {
            color: #959aa0;
        }
    </style>
    <div id="non-printable">
        <section class="section">
            <div class="section-header ">
                <a class="btn btn-primary" href="{{ route('warehouse.finishing.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="ml-2">Input Data | Produk Keluar</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{ route('warehouse.finishing.storekeluar', [$finish->id]) }}" method="post">
                                @csrf
                                @include('backend.include.alert')

                                <div class="alert" role="alert" id="dataalert">

                                </div>
                                <input type="hidden" name="id" id="idbahan" value="{{ $finish->id }}">
                                <input type="hidden" name="status" value="kirim warehouse">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kode_transaksi">Kode Transaksi</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $finish->cuci->jahit->potong->bahan->kode_transaksi }}"
                                                    readonly required id="kode_transaksi" name="kode_transaksi">


                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_surat">Nomor Surat Jalan</label>
                                                <input type="text" class="form-control" value="{{ $finish->no_surat }}"
                                                    required id="no_surat" name="no_surat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggal_selesai">Tanggal Selesai Sortir</label>
                                                <input type="date" class="form-control" required id="tanggal_selesai"
                                                    name="tanggal_selesai" value="{{ $finish->tanggal_selesai }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sku">Kode SKU</label>
                                                <input type="text" class="form-control" readonly required id="sku"
                                                    value="{{ $finish->cuci->jahit->potong->bahan->sku }}" name="sku">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="barang_siap_qc">Stok Siap Sortir</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" readonly required
                                                        value="{{ $finish->barang_siap_qc }}" id="barang_siap_qc"
                                                        name="barang_siap_qc">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">pcs</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="stok_lolos_sortir">Stok Lolos Sortir</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" required
                                                        value="{{ $finish->barang_lolos_qc }}" id="stok_lolos_sortir"
                                                        name="stok_lolos_sortir">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">pcs</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gagal_qc">Produk Gagal QC</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" required readonly
                                                        value="{{ $finish->barang_gagal_qc }}" id="gagal_qc"
                                                        name="gagal_qc">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">pcs</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                    <label for="ukurandiretur" class="text-dark">Ukuran lolos sortir</label>
                                    <div class="row">
                                        @forelse ($finish->detail_finish as $item)
                                            <div class="col-md-2">
                                                <input type="hidden" name="dataukuran[]" value="{{ $item->ukuran }}">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{ $item->ukuran }}</div>
                                                    </div>
                                                    <input type="number" class="form-control" required id="jumlahutama"
                                                        name="jumlahutama[]" placeholder="{{ $item->jumlah }}"
                                                        max="{{ $item->jumlah }}" min="0">
                                                </div>
                                            </div>
                                            @if ($loop->iteration % 6 == 0)
                                    </div>
                                    <div class="row">
                                        @endif
                                    @empty
                                        @endforelse
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="barang_diretur">Produk Diretur</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" required
                                                        value="{{ $finish->barang_diretur }}" id="barang_diretur"
                                                        name="produk_diretur">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">pcs</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="ukurandiretur" class="text-dark">Ukuran yang Diretur</label>
                                    <div class="row">
                                        @forelse ($finish->detail_finish as $item)
                                            <div class="col-md-2">
                                                <input type="hidden" name="dataukurandiretur[]"
                                                    value="{{ $item->ukuran }}">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{ $item->ukuran }}</div>
                                                    </div>
                                                    <input type="number" class="form-control" required
                                                        id="jumlahdiretur" name="jumlahdiretur[]">
                                                </div>
                                            </div>
                                            @if ($loop->iteration % 6 == 0)
                                    </div>
                                    <div class="row">
                                        @endif
                                    @empty
                                        @endforelse
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="keterangan_diretur">Keterangan Produk Diretur</label>
                                                <textarea class="form-control" id="keterangan_diretur" name="keterangan_diretur" rows="3">{{ $finish->keterangan_diretur }}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="barang_dibuang">Produk Dibuang</label>
                                                <div class="input-group mb-2">
                                                    <input type="number" class="form-control" readonly required
                                                        value="{{ $finish->barang_dibuang }}" id="barang_dibuang"
                                                        name="produk_dibuang">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">pcs</div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <label for="ukurandibuang" class="text-dark">Ukuran yang Dibuang</label>
                                    <div class="row">
                                        @forelse ($finish->detail_finish as $item)
                                            <div class="col-md-2">
                                                <input type="hidden" name="dataukurandibuang[]"
                                                    value="{{ $item->ukuran }}">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">{{ $item->ukuran }}</div>
                                                    </div>
                                                    <input type="number" class="form-control" required
                                                        id="jumlahdibuang" name="jumlahdibuang[]">
                                                </div>
                                            </div>
                                            @if ($loop->iteration % 6 == 0)
                                    </div>
                                    <div class="row">
                                        @endif
                                    @empty
                                        @endforelse
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="keterangan_dibuang">Keterangan Produk Dibuang</label>
                                                <textarea class="form-control" id="keterangan_dibuang" name="keterangan_dibuang" rows="6">{{ $finish->keterangan_dibuang }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a type="button" class="btn btn-secondary"
                                                href="{{ route('warehouse.finishing.index') }}">Batal</a>
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
        $(document).ready(function() {
            function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }

            $('#dataalert').hide()
            $('form[id=formProduk]').submit(function() {
                $('#dataalert').addClass('alert-danger')
                var jumlahdiretur = 0;
                var jumlahutama = 0;
                var jumlahdibuang = 0;
                var barang_siap_qc = $("#barang_siap_qc").val()
                var gagal_qc = $("#gagal_qc").val()
                var stok_lolos_sortir = $('#stok_lolos_sortir').val()
                var barang_dibuang = $('#barang_dibuang').val()
                var barang_diretur = $('#barang_diretur').val()
                $('input[name^="jumlahdiretur"]').each(function() {
                    jumlahdiretur = jumlahdiretur + parseInt($(this).val());
                });
                $('input[name^="jumlahutama"]').each(function() {
                    jumlahutama = jumlahutama + parseInt($(this).val());
                });
                $('input[name^="jumlahdibuang"]').each(function() {
                    jumlahdibuang = jumlahdibuang + parseInt($(this).val());
                });
                if (parseInt(stok_lolos_sortir) > parseInt(barang_siap_qc)) {
                    $('#dataalert').show()
                    $('#dataalert').text(
                        'Jumlah Stok Lolos Sortir tidak boleh melebihi Jumlah Stok Siap Sortir')
                    return false;
                } else if (parseInt(barang_diretur) > parseInt(gagal_qc)) {
                    $('#dataalert').show()
                    $('#dataalert').text(
                        'Jumlah produk diretur tidak boleh melebihi Jumlah produk gagal qc')
                    return false;
                } else if (parseInt(jumlahutama) != parseInt(stok_lolos_sortir)) {

                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran harus sesuai dengan jumlah Stok lolos Sortir')
                    return false;
                } else if (parseInt(jumlahdiretur) != parseInt(barang_diretur)) {
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran retur harus sesuai dengan jumlah produk diretur')
                    return false;
                } else if (parseInt(jumlahdibuang) != parseInt(barang_dibuang)) {
                    $('#dataalert').show()
                    $('#dataalert').text('Jumlah ukuran dibuang harus sesuai dengan jumlah dibuang')
                    return false;
                } else {
                    $('#dataalert').hide()
                    return true;
                }
            });
            $('#stok_lolos_sortir').on('keyup', function() {
                var data = $(this).val()
                var jumlah_bahan = $('#barang_siap_qc').val()

                if (parseInt(data) <= parseInt(jumlah_bahan)) {
                    var res = parseInt(jumlah_bahan) - parseInt(data);
                    $('#gagal_qc').val(res)
                } else {
                    $('#gagal_qc').val(0)
                }
            })

            $('#barang_diretur').on('keyup', function() {
                var nilai = $(this).val()
                var dibuang = $('#gagal_qc').val()
                nilai = parseInt(nilai)
                dibuang = parseInt(dibuang)
                if (nilai == 0) {
                    $('#barang_dibuang').val(dibuang)
                } else {
                    if (nilai > 0 && dibuang > 0 && dibuang >= nilai) {
                        var res = dibuang - nilai;
                        $('#barang_dibuang').val(res)
                    } else {
                        $('#barang_dibuang').val(0)
                    }
                }
            })


        })
    </script>
@endpush
