@extends('ecommerce.frontend.main')

@section('content')
    <style>
        .text-gray {
            color: #8E8E93;
        }

        .badge-primary {
            background-color: #FF3B30;
        }

        h5,
        h6,
        h4 {
            font-family: 'Heebo', sans-serif;
        }
    </style>
    <div class="breadcrumb-area bg-white" style="margin-top: -2%">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="{{ route('frontend.user.pembelian.index') }}" class="text-left"><i class="ri-arrow-left-line"></i>
                        Kembali</a>

                </div>
                <div class="col-md-10" style="margin-left: -80px !important;">
                    <h3 class="text-center">Detail Pembelian</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="my-account-wrapper  pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <!-- My Account Tab Menu End -->
                            <!-- My Account Tab Content Start -->
                            <div class="col-md-12  mt-3">

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card shadow mt-2" style="border-radius: 10px">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12">
                                                                    <div>
                                                                        <div style="display:inline-block">
                                                                            <h3>{{ $transaksi->alamat->jenis_alamat }}
                                                                                {{ $transaksi->alamat->kota }} </h3>
                                                                        </div>

                                                                    </div>
                                                                    <div class="pt-20">
                                                                        <div style="display:inline-block">
                                                                            <h4>{{ $transaksi->alamat->nama_penerima }}
                                                                            </h4>
                                                                        </div>

                                                                    </div>
                                                                    <div class="pt-5">
                                                                        <p>{{ $transaksi->alamat->no_telp }}</p>
                                                                        <p style="margin-top:-5px">
                                                                            {{ $transaksi->alamat->alamat_detail }},
                                                                            {{ $transaksi->alamat->kecamatan }},
                                                                            {{ $transaksi->alamat->kota }},
                                                                            {{ $transaksi->alamat->kode_pos }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="card-title font-weight-bold ">
                                                                    <span class="mr-4"> Pembelian
                                                                        {{ date('j F Y', strtotime($transaksi->created_at)) }}</span>
                                                                    <span class="mr-4"
                                                                        style="color:#FF3B30">{{ $transaksi->kode_transaksi }}</span>
                                                                    @if ($transaksi->status_bayar == 'sudah di upload')
                                                                        <span class="badge badge-warning p-2">MENUNGGU
                                                                            VERIFIKASI</span>
                                                                    @elseif ($transaksi->status_bayar == 'sudah dibayar' && $transaksi->status == 'dikirim')
                                                                        <span class="badge badge-warning p-2">DIKIRIM</span>
                                                                    @elseif ($transaksi->status == 'telah tiba')
                                                                        <span class="badge badge-success p-2">SELESAI</span>
                                                                    @elseif ($transaksi->status_bayar == 'sudah dibayar')
                                                                        @if ($transaksi->status == 'refund')
                                                                            <span
                                                                                class="badge badge-secondary p-2">DIREFUND</span>
                                                                        @else
                                                                            <span class="badge badge-warning p-2">PROSES
                                                                                KIRIM</span>
                                                                        @endif
                                                                    @elseif ($transaksi->status_bayar == 'dibatalkan')
                                                                        <span
                                                                            class="badge badge-danger p-2">DIBATALKAN</span>
                                                                    @endif

                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                @forelse ($transaksi->detail_transaksi as $row)
                                                                    <div class="row mt-1">
                                                                        <div class="col-md-4">
                                                                            <img src="{{ asset('uploads/images/produk/' . $row->produk->detail_gambar[0]->filename) }}"
                                                                                class="rounded" alt=""
                                                                                style="width: 100%" srcset="">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <h5 class="font-weight-bold mt-2">
                                                                                {{ $row->produk->nama_produk }}</h5>
                                                                            <h5 class="font-weight-bold text-secondary">
                                                                                Qty {{ $row->jumlah }} seri</h5>
                                                                            <h5 class="font-weight-bold text-secondary">
                                                                                @rupiah($row->total_harga)</h5>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                @endforelse

                                                            </div>
                                                            <div class="col-md-4"
                                                                style="border-left: 1px solid #C7C7CC; border-right:1px solid #C7C7CC">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <img src="{{ asset('uploads/images/bank/' . $transaksi->bank->logo) }}"
                                                                            style="width: 100%" class="mt-3"
                                                                            alt="" srcset="">
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <h5 class="text-secondary mt-3">
                                                                            Metode Pembayaran</h5>
                                                                        <h5 class="font-weight-bold">
                                                                            Transfer Manual
                                                                            {{ $transaksi->bank->nama_bank }}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5 class="text-secondary mt-3">
                                                                            Total Belanja</h5>
                                                                        <h5 class="font-weight-bold" style="color:#FF3B30">

                                                                            @rupiah($transaksi->total_harga)</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>


@endsection
