@extends('ecommerce.offline.master')
@section('title', 'Transaksi')
@section('title-nav', 'Transaksi')
@section('transaksi', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')
    <style>
        .dropzone {
            border: 2px dashed #dedede;
            border-radius: 5px;
            background: #f5f5f5;
        }

        .dropzone i {
            font-size: 5rem;
        }

        .dropzone .dz-message {
            color: rgba(0, 0, 0, .54);
            font-weight: 500;
            font-size: initial;

        }

        .cssnav {
            margin-left: 10px;
        }

    </style>

    <div id="non-printable">
        <section class="section">
            <div class="section-header ">

                <h1 class="ml-2">Cetak Label</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @include('ecommerce.admin.include.alert')
                                <form id="form_transaksi" method="GET" target="_blank" action="{{route('offline.cetak_label.cetak')}}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="produk">Plih Produk</label>
                                                <select class="form-control" id="produk" required name="produk">

                                                    @forelse ($produk as $item)
                                                        <option value="{{ $item->id }}">{{ $item->kode_produk }} |
                                                            {{ $item->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Cetak</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>

@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script>
        $(document).ready(function() {

            $('#barang').select2()
            $('#produk').select2()
            $('#ukuran').select2()
            $('#promo').select2()


        })
    </script>
@endpush
