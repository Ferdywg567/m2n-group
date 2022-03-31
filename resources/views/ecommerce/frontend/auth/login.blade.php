@extends('layouts.begin_auth')
@section('title')
Login
@endsection
@section('content')
<style>
    .line-text {
        width: 100%;
        text-align: center;
        border-bottom: 1px solid #000;
        line-height: 0.1em;
        margin: 10px 0 20px;
    }

    .line-text span {
        background: #fff;
        padding: 0 10px;
    }
</style>
<div class="row g-0">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-8 mx-auto">
                        <div class="mb-3" style="margin-left: -1%">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{asset('/assets/img/M2N 1.png')}}" alt="" srcset="" width="60">
                                </div>
                                <div class="col-md-10">
                                    <h4 class="mt-2" style="font-weight: bold">M2N STORE</h4>
                                </div>
                            </div>


                        </div>
                        <h3 class="login-heading mb-4 fw-bold" style="font-weight: bold">Masuk</h3>
                        @include('backend.include.alert')
                        <!-- Sign In Form -->
                        <form method="POST" action="{{route('frontend.auth.post.login')}}">
                            @csrf
                            <div class="form-floating mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" required id="email" name="email"
                                    placeholder="name@example.com">

                            </div>
                            <div class="form-floating mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" required id="password"
                                    placeholder="Password">

                            </div>

                            <div class="d-grid">
                                <button class="btn  btn-login btn-block  fw-bold mb-2 text-white p-2"
                                    style="background-color: #FF3B30" type="submit">Masuk</button>
                            </div>
                            <div class="d-grid mt-3">
                                <p class="line-text"><span>atau masuk dengan cara lain</span></p>
                            </div>
                            <div class="d-grid">
                                <a class="btn btn-outline-dark  btn-block" href="{{route('frontend.auth.google')}}" role="button"
                                    style="text-transform:none">
                                    <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in"
                                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                                    Masuk menggunakan google
                                </a>
                            </div>
                            <div class="d-grid text-center mt-3">
                                <p>Belum punya akun ? <a href="{{route('frontend.auth.register')}}">Daftar</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
