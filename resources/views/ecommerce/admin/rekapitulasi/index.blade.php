@extends('ecommerce.admin.master')
@section('title', 'Rekapitulasi')
@section('title-nav', 'Rekapitulasi')
@section('rekapitulasi', 'class=active-sidebar')
@section('content')
<style>


    .dropdown-menu {
        left: 50% !important;
        transform: translateX(-50%) !important;
        top: 100% !important;
    }
</style>
<section class="section mt-4">

    <div class="section-body mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">

                        <table class="table table-hover" id="tabelrekap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Tgl Transaksi</th>
                                    <th scope="col">Total</th>

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


              $('#tabelrekap').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })


     })
</script>
@endpush

