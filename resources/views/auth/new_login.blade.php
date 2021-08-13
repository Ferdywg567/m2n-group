@extends('layouts.begin_auth')
@section('title')
Login
@endsection
@section('content')
<div class="row g-0">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-8 mx-auto">
                        <h3 class="login-heading mb-4">Masuk</h3>
                        @include('backend.include.alert')
                        <!-- Sign In Form -->
                        <form method="POST" action="{{route("backend.login")}}">
                            @csrf
                            <div class="form-floating mb-3">
                                <label for="email">Email atau Nomor HP</label>
                                <input type="email" class="form-control" required id="email" name="email"
                                    placeholder="name@example.com">

                            </div>
                            <div class="form-floating mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" required id="password"
                                    placeholder="Password">

                            </div>

                            <div class="d-grid">
                                <button class="btn  btn-primary btn-login btn-block  fw-bold mb-2"
                                    type="submit">Masuk</button>
                                <div class="text-center">
                                    <a class="small" href="#">Forgot password?</a>
                                </div>
                            </div>
                            <div class="d-grid mt-2">
                                <div class="text-center">
                                    <h6 class="small line" href="#"><span>atau masuk dengan cara lain</span></h6>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button class="btn  border btn-google btn-block btn-login  btn-outline fw-bold"
                                    type="button"><img src="{{asset('assets/img/google.png')}}" width="25">
                                    Masuk menggunakan google</button>

                            </div>
                            <div class="d-grid mt-2">
                                <div class="text-center">
                                    <h6 class="small">Belum punya akun ? <a href="#">Daftar</a></h6>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
