@extends('ecommerce.frontend.main')

@section('content')
<div class="my-account-wrapper pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">


                        <!-- My Account Tab Menu End -->
                        <!-- My Account Tab Content Start -->
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-biodata-tab" data-toggle="tab"
                                        href="#nav-biodata" role="tab" aria-controls="nav-biodata"
                                        aria-selected="true">Biodata Diri</a>
                                    <a class="nav-item nav-link" id="nav-alamat-tab" data-toggle="tab"
                                        href="#nav-alamat" role="tab" aria-controls="nav-alamat"
                                        aria-selected="false">Daftar Alamat</a>

                                </div>
                            </nav>
                            <div class="tab-content ml-2 mr-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-biodata" role="tabpanel"
                                    aria-labelledby="nav-biodata-tab">
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="card" style="width: 18rem;">
                                                <img class="card-img-top"
                                                    src="{{asset('ecommerce/assets/images/product/product-13.jpg')}}"
                                                    alt="Card image cap">
                                                <div class="card-body">

                                                    <p class="card-text">Some quick example text to build on the card
                                                        title and make up
                                                        the bulk of the card's content.</p>
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-outline-dark">Ubah Kata
                                                            Sandi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                    <p>Hello, <strong>Alex Tuntuni</strong> (If Not <strong>Tuntuni
                                                            !</strong><a href="login-register.html" class="logout">
                                                            Logout</a>)</p>
                                                </div>

                                                <p class="mb-0">From your account dashboard. you can easily check &amp;
                                                    view
                                                    your recent orders, manage your shipping and billing addresses and
                                                    edit your
                                                    password and account details.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade show" id="nav-alamat" role="tabpanel"
                                aria-labelledby="nav-alamat-tab">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary">Tambah Alamat Baru</button>
                                        <div class="card mt-2">
                                            <div class="card-body">
                                              This is some text within a card body.
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
