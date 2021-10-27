@extends('ecommerce.frontend.main')

@section('content')
<style>
    .text-gray {
        color: #8E8E93;
    }

    .badge-primary {
        background-color: #FF3B30;
    }
</style>
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
                                                        <button type="button"
                                                            class="btn btn-outline-dark btn-block">Ubah Kata
                                                            Sandi</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h3 class="text-gray">Biodata Diri</h3>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <h5 class="text-gray">Nama </h5>
                                                </div>

                                                <div class="col-md-6">
                                                    <h5>{{auth()->user()->name}}</h5>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <h5 class="text-gray">Tanggal Lahir </h5>
                                                </div>

                                                <div class="col-md-6">
                                                    <h5>{{auth()->user()->tanggal_lahir}}</h5>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <h5 class="text-gray">Jenis Kelamin </h5>
                                                </div>

                                                <div class="col-md-6">
                                                    <h5>{{auth()->user()->jenis_kelamin}}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <h3 class="text-gray">Kontak</h3>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <h5 class="text-gray">Email </h5>
                                                </div>

                                                <div class="col-md-3">
                                                    <h5>{{auth()->user()->email}}</h5>
                                                </div>
                                                <div class="col-md-6" style="margin-top:-4px; display:inline-block">
                                                    <span class="badge badge-primary">Belum terverifikasi</span> <a
                                                        href="http://" class="ml-2">verifikasi sekarang</a>
                                                </div>

                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-2">
                                                    <h5 class="text-gray">Nomor HP</h5>
                                                </div>
                                                @if (auth()->user()->no_hp != null)
                                                <div class="col-md-2">
                                                    <h5>{{auth()->user()->no_hp}}</h5>
                                                </div>
                                                <div class="col-md-6" style="margin-top:-4px; display:inline-block">
                                                    <span class="badge badge-success">Terverifikasi</span>
                                                </div>
                                                @endif


                                            </div>
                                            <hr>
                                            <button type="button" class="btn btn-primary ubahprofile">Ubah Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="nav-alamat" role="tabpanel"
                                    aria-labelledby="nav-alamat-tab">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary">Tambah Alamat Baru</button>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card mt-2"
                                                        style="background-color: rgba(0, 123, 255, 0.29); border-color:#007bff">
                                                        <div class="card-body">
                                                            <div>
                                                                <div style="display:inline-block">
                                                                    <h3>Kantor Sidoarjo </h3>
                                                                </div>
                                                                <div style="display:inline-block" class="ml-2">
                                                                    <h5>Utama</h5>
                                                                </div>

                                                            </div>
                                                            <div class="pt-20">
                                                                <div style="display:inline-block">
                                                                    <h3>Ryan Ardito </h3>
                                                                </div>

                                                            </div>
                                                            <div class="pt-5">
                                                                <p>628123456789</p>
                                                                <p style="margin-top:-5px">Dusun Balongbiru Desa Sadang
                                                                    RT. 08 RW. 03 Gang 8X No. 5,
                                                                    Sidoarjo</p>
                                                            </div>
                                                            <div class="pt-10">
                                                                <div style="display:inline-block">
                                                                    <a href="http://">Ubah Alamat</a>
                                                                </div>
                                                                <div style="display:inline-block" class="ml-2">
                                                                    <a href="http://">Hapus Alamat</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card mt-2">
                                                        <div class="card-body">
                                                            <div>
                                                                <div style="display:inline-block">
                                                                    <h3>Kantor Sidoarjo </h3>
                                                                </div>
                                                                <div style="display:inline-block" class="ml-2">
                                                                    <h5>Utama</h5>
                                                                </div>

                                                            </div>
                                                            <div class="pt-20">
                                                                <div style="display:inline-block">
                                                                    <h3>Ryan Ardito </h3>
                                                                </div>

                                                            </div>
                                                            <div class="pt-5">
                                                                <p>628123456789</p>
                                                                <p style="margin-top:-5px">Dusun Balongbiru Desa Sadang
                                                                    RT. 08 RW. 03 Gang 8X No. 5,
                                                                    Sidoarjo</p>
                                                            </div>
                                                            <div class="pt-10">
                                                                <div style="display:inline-block">
                                                                    <a href="http://">Ubah Alamat</a>
                                                                </div>
                                                                <div style="display:inline-block" class="ml-2">
                                                                    <a href="http://">Hapus Alamat</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
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

{{-- //modal profile user --}}
<!-- Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="profileModalLabel">Ubah Biodata</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formBiodata">
                <div id="data-alert-biodata">

                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{auth()->user()->name}}">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir"
                                    value="{{auth()->user()->tanggal_lahir}}" name="tanggal_lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Pria" @if(auth()->user()->jenis_kelamin == 'Pria') selected
                                        @endif>Pria</option>
                                    <option value="Wanita" @if(auth()->user()->jenis_kelamin == 'Wanita') selected
                                        @endif>Wanita</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" value="{{auth()->user()->email}}"
                                    name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp">Nomor Hp</label>
                                <input type="text" class="form-control" id="nomor_hp" value="{{auth()->user()->no_hp}}"
                                    name="nomor_hp">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btnSimpanBiodata">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        }
        $('.ubahprofile').on('click', function () {
            $('#profileModal').modal('show')
            $('#data-alert-biodata').empty()
         })

         $('.btnSimpanBiodata').on('click', function () {
                var form = $('#formBiodata').serialize()
                ajax()
                $.ajax({
                    url:"{{route('frontend.user.store')}}",
                    method:"POST",
                    data:form,
                    success:function(response){
                        if(response.status){
                            setTimeout(function () {   $('#profileModal').modal('hide') ; window.location.reload(true)  },1500)
                        }
                        $('#data-alert-biodata').html(response.data)
                    }
                })
          })
    })
</script>
@endpush
