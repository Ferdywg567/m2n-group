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
                            <div class="mb-3" style="margin-left: -1%">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ asset('/assets/img/M2N 1.png') }}" alt="" srcset="" width="60">
                                    </div>
                                    <div class="col-md-10">
                                        <h4 class="mt-2" style="font-weight: bold">M2N GROUP SYSTEM</h4>
                                    </div>
                                </div>


                            </div>
                            <h3 class="login-heading mb-4 fw-bold" style="font-weight: bold">Masuk</h3>
                            @include('backend.include.alert')
                            <!-- Sign In Form -->
                            <form method="POST" action="{{ route('backend.login') }}">
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
                                    <button class="btn  btn-login btn-block  fw-bold mb-2 text-white p-3"
                                        style="background-color: #FF3B30" type="submit">Masuk</button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
