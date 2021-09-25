@extends('ecommerce.frontend.main')

@section('content')
<style>
    .btn-outline-primary {
        color: #FF3B30;
        border-color: #FF3B30;
    }
    .btn-outline-primary:hover {
        background: #FF3B30;
        color: white;
        border-color: #FF3B30;
    }
</style>
<div class="breadcrumb-area bg-white" style="margin-top: -2%">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="/" class="text-left"><i class="ri-arrow-left-line"></i> Kembali</a>

            </div>
            <div class="col-md-10" style="margin-left: -80px !important;">
                <h3 class="text-center">Checkout</h3>
            </div>
        </div>
    </div>
</div>
<div class="cart-main-area  pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                    <h5>Alamat Pengiriman</h5>
                    <hr>
                    <h5>Samantha William</h5>
                    <h6>+6281200021938</h6>
                    <h5>Perumahan Pabean Asri BLOK F8, Sedati, Sidoarjo, Jawa Timur, 61257</h5>
                    <hr>
                    <button type="button" class="btn btn-outline-primary">Pilih Alamat Lain</button>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="grand-totall">
                    <h5 style="margin-top: -15px">Ringkasan Pembelian</h5>
                    <h6>Total Produk <span>Rp. 1,000,000</span></h6>
                    <h6>Ongkos Kirim <span>RP. 112,000</span></h6>
                    <h5>Total Tagihan <span>Rp. 1,112,000</span></h5>
                    <button type="button" class="btn btn-primary btn-block"><i class="ri-shield-check-line" ></i> Bayar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
