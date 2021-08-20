@extends('backend.master')

@section('title', 'Sampah')
@section('title-nav', 'Sampah')
@section('sampah', 'class=active-sidebar')

@section('content')

<div id="non-printable">
    <section class="section mt-2">
        <a href="{{route('print.index')}}" class="btn btn-outline-primary rounded ml-1">Print Semua <i class="ri-printer-fill"></i>
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
                                        <th scope="col">Barang Rusak</th>

                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @forelse ($sampah as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->bahan->kode_bahan}}</td>
                                        <td>{{$item->bahan->sku}}</td>
                                        <td>{{$item->bahan->tanggal_masuk}}</td>
                                        <td>{{$item->total}}</td>
                                        <td>
                                            <a href="{{route('sampah.show',[$item->id])}}" class="btn btn-outline-primary">Detail</a>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

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
