@extends('ecommerce.admin.master')
@section('title', 'Produk')
@section('title-nav', 'Produk')
@section('produk', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav{
       margin-left:-20px;
    }
</style>

<section class="section mt-4">
    <div class="btn-group">
        <a href="{{route('ecommerce.produk.create')}}" class="btn btn-primary rounded">
            Input Data <i class="fas fa-plus"></i>
        </a>
    </div>
    <div class="section-body mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">

                        <table class="table table-hover" id="tabelproduk">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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


              $('#tabelproduk').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })


     })
</script>
@endpush
