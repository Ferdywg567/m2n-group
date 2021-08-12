@extends('backend.master')

@section('title', 'Retur')
@section('title-nav', 'Retur')
@section('retur', 'class=active')

@section('content')
<style>
    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
</style>
<div id="non-printable">
    <section class="section mt-5">
        <a href="{{route('print.index')}}" class="btn btn-outline-primary rounded ml-1">Print Semua <i class="fas fa-print"></i>
        </a>
        <div class="section-body mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <table class="table table-hover" id="tabelbahanmasuk">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Bahan</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Tgl Masuk</th>
                                        <th scope="col">Barang Repair</th>
                                        <th scope="col">Surat Jalan</th>
                                        <th scope="col">Status</th>
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


</div>

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

              $('#tabelbahanmasuk').DataTable()
              $('#tabelbahankeluar').DataTable()
              


     })
</script>
@endpush
