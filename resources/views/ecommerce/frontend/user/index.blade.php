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
                                                <div class="text-center mt-3">
                                                    <img class="card-img-top rounded text-center"
                                                    src="{{asset('ecommerce/assets/images/product/product-13.jpg')}}"
                                                    alt="Card image cap" style="width:90%">
                                                </div>
                                                <div class="card-body">
                                                    <button type="button"
                                                    class="btn btn-outline-dark btn-block mt-3">Pilih Foto</button>
                                                    <p class="card-text">Some quick example text to build on the card
                                                        title and make up
                                                        the bulk of the card's content.</p>

                                                </div>
                                            </div>

                                            <button type="button" style="  padding: 9px 85px;  display: inline-block; "
                                            class="btn btn-outline-dark mt-3">Ubah Kata
                                            Sandi</button>
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
                                            <button type="button" class="btn btn-primary btntambahalamat">Tambah Alamat
                                                Baru</button>
                                            @forelse ($alamat as $item)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card mt-2" @if($item->status == 'Utama') style="
                                                        border-color:#007bff" @endif >
                                                        <div class="card-body">
                                                            <div>
                                                                <div style="display:inline-block">
                                                                    <h3>{{$item->jenis_alamat}} {{$item->kota}} </h3>
                                                                </div>
                                                                @if ($item->status == 'Utama')
                                                                <div style="display:inline-block" class="ml-2">
                                                                    <h5>{{$item->status}}</h5>
                                                                </div>

                                                                @endif

                                                            </div>
                                                            <div class="pt-20">
                                                                <div style="display:inline-block">
                                                                    <h3>{{$item->nama_penerima}} </h3>
                                                                </div>

                                                            </div>
                                                            <div class="pt-5">
                                                                <p>{{$item->no_telp}}</p>
                                                                <p style="margin-top:-5px">{{$item->alamat_detail}}</p>
                                                            </div>
                                                            <div class="pt-10">
                                                                <div style="display:inline-block">
                                                                    <a href="#" data-id="{{$item->id}}"
                                                                        class="ubah_alamat">Ubah Alamat</a>
                                                                </div>
                                                                <div style="display:inline-block" class="ml-2">
                                                                    <a href="#" data-id="{{$item->id}}" class="hapus_alamat">Hapus Alamat</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty

                                            @endforelse

                                            {{-- <div class="row">
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
                                            </div> --}}
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

<!-- Modal Alamat -->
<div class="modal fade" id="modalAlamat" tabindex="-1" role="dialog" aria-labelledby="modalAlamatLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalAlamatLabel">Tambah Alamat Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formalamat">
                <div id="data-alert-alamat">

                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_alamat" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_penerima">Nama Penerima</label>
                                <input type="text" class="form-control" id="nama_penerima" name="nama_penerima">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telp">No. Telp</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_alamat">Jenis Alamat</label>
                                <select class="form-control" id="jenis_alamat" name="jenis_alamat">
                                    <option value="Rumah">Rumah</option>
                                    <option value="Kantor">Kantor</option>
                                    <option value="Sekolah">Sekolah</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_alamat">Status Alamat</label>
                                <select class="form-control" id="status_alamat" name="status_alamat">
                                    <option value="Utama">Utama</option>
                                    <option value="Tidak Utama">Tidak Utama</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat_detail">Alamat Detail</label>
                                <textarea class="form-control" id="alamat_detail" name="alamat_detail"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kode_pos">Kode Pos</label>
                                <input type="text" class="form-control" id="kode_pos" name="kode_pos">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btnModalAlamat">Simpan</button>
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

          $('.btntambahalamat').on('click', function () {
                $('#modalAlamat').modal('show')
                $('#data-alert-alamat').empty()
                $('.btnModalAlamat').addClass('btnSimpanAlamat')
                $('.btnModalAlamat').removeClass('btnUpdateAlamat')
                $('#modalAlamatLabel').text('Tambah Alamat Baru')
          })

          $(document).on('click','.btnSimpanAlamat', function () {
                var form = $('#formalamat').serialize()
                ajax()
                $.ajax({
                    url:"{{route('frontend.alamat.store')}}",
                    method:"POST",
                    data:form,
                    success:function(response){
                        if(response.status){
                            setTimeout(function () {   $('#modalAlamat').modal('hide') ; window.location.reload(true)  },1500)
                        }
                        $('#data-alert-alamat').html(response.data)
                    }
                })
          })

          $('.ubah_alamat').on('click', function () {
                $('#modalAlamat').modal('show')
                $('#data-alert-alamat').empty()
                var id = $(this).data('id')
                $('.btnModalAlamat').removeClass('btnSimpanAlamat')
                $('.btnModalAlamat').addClass('btnUpdateAlamat')
                $('#modalAlamatLabel').text('Ubah Alamat')
                $.ajax({
                    url:"{{route('frontend.alamat.get_alamat')}}",
                    method:"GET",
                    data:{
                        id:id
                    },success:function(response){
                        if(response.status){
                            var data = response.data
                            $('#id_alamat').val(id)
                            $('#nama_penerima').val(data.nama_penerima)
                            $('#no_telp').val(data.no_telp)
                            $('#jenis_alamat').val(data.jenis_alamat).change()
                            $('#status_alamat').val(data.status).change()
                            $('#alamat_detail').val(data.alamat_detail)
                            $('#kota').val(data.kota)
                            $('#kecamatan').val(data.kecamatan)
                            $('#kode_pos').val(data.kode_pos)

                        }
                    }
                })
          })

          $(document).on('click','.btnUpdateAlamat', function () {
                var form = $('#formalamat').serialize()
                ajax()
                $.ajax({
                    url:"{{route('frontend.alamat.update_alamat')}}",
                    method:"POST",
                    data:form,
                    success:function(response){
                        if(response.status){
                            setTimeout(function () {   $('#modalAlamat').modal('hide') ; window.location.reload(true)  },1500)
                        }
                        $('#data-alert-alamat').html(response.data)
                    }
                })
          })

          $(document).on('click','.hapus_alamat',function () {
                var id = $(this).data('id')
                swal({
                    title: "Apa anda yakin?",
                    text: "Ketika dihapus, data tidak bisa dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        ajax()
                        $.ajax({
                            url:"{{url('ecommerce/alamat/')}}/"+id,
                            method:"DELETE",
                            success:function(data){
                                if(data.status){
                                    swal("Success! data berhasil dihapus!", {
                                         icon: "success",
                                    });
                                    setTimeout(function () {  location.reload(true) },1500)

                                }else{
                                    swal("Maaf, data tidak bisa dihapus!");
                                }
                            }
                       })

                    }
                    });
           })
    })
</script>
@endpush
