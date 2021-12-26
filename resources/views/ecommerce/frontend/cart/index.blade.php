@extends('ecommerce.frontend.main')

@section('content')
<div class="breadcrumb-area bg-white" style="margin-top: -2%">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a onclick="GoBackWithRefresh();return false;" href="#" class="text-left"><i
                        class="ri-arrow-left-line"></i> Kembali</a>

            </div>
            <div class="col-md-10" style="margin-left: -95px !important;">
                <h3 class="text-center">Keranjang</h3>
            </div>
        </div>
    </div>
</div>
<div class="cart-main-area  pb-120">
    <div class="container">



        @if (count($keranjang) > 0)
        <div id="data-alert-cart">

        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <form action="#">
                    <div class="table-content table-responsive cart-table-content">


                        <table>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="all" id="all" @if($checked) checked @endif
                                            style="width: 15px"></th>
                                    <th>Produk</th>
                                    <th></th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalharga = 0;
                                @endphp
                                @forelse ($keranjang as $item)
                                @if($item->check==1)
                                @php
                                $totalharga += $item->subtotal;
                                @endphp
                                @endif
                                <tr>
                                    <td><input type="checkbox" name="cart" id="" class="btncheck" @if($item->check==1)
                                        checked @endif data-id="{{$item->id}}" style="width: 15px"></td>
                                    <td class="product-thumbnail">
                                        <a href="#"><img
                                                src="{{asset('uploads/images/produk/'.$item->produk->detail_gambar[0]->filename)}}"
                                                alt="" width="80"></a>
                                    </td>
                                    <td class="product-name" style="text-align: left">
                                        <a href="#" style="">{{$item->produk->nama_produk}}</a>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="#" style="font-size: 11px; color:#8E8E93" data-id="{{$item->produk_id}}" class="wishlist-cart"><i
                                                        class="ri-heart-add-line"></i> Tambahkan ke favorit</a>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="product-price-cart"><span class="amount">@rupiah($item->harga)</span>
                                    </td>
                                    <td class="product-quantity pro-details-quality">
                                        <div class="cart-plus-minus">

                                            <input class="cart-plus-minus-box jumlah" type="text"
                                                value="{{$item->jumlah}}" data-id="{{$item->id}}" name="qtybutton"
                                                id="jumlah" value="1">


                                        </div>
                                    </td>
                                    <td class="product-subtotal subtotal">@rupiah($item->subtotal)</td>
                                    <td class="product-remove">
                                        <a href="{{route('frontend.keranjang.hapus',[$item->id])}}"><i
                                                class="icon_close"></i></a>
                                    </td>
                                </tr>
                                @empty

                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="row pt-50">
            <div class="col-md-12">
                <div class="card" style="background-color: black">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="text-white pt-5 totalharga">Total : @rupiah($totalharga)</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-light pl-5 pr-5 btncheckout" @if($totalharga==0)
                                    disabled @endif><i class="ri-money-dollar-circle-line"></i> Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <h3>Keranjang Belanja Anda Masih Kosong</h3>
                <a href="{{route('landingpage.index')}}" class="btn btn-primary btn-lg mt-2"
                    style="border-radius:15px">Lihat Produk</a>
            </div>
        </div>
        @endif


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
            // $('input:checkbox').attr('checked','checked');
            $('#all').on('click', function () {
                var nilai = $(this).is(":checked")
                if(nilai){
                    $('input:checkbox').prop('checked','checked');
                }else{
                    $('input:checkbox').prop('checked',false);
                }
                ajax()
                $.ajax({
                        url:"{{route('frontend.keranjang.update_checkbox')}}",
                        method:"POST",
                        data:{
                            update:'all',
                            nilai:nilai
                        }, success:function(response){
                            if(response.status){
                                    $('.totalharga').text('Total : '+response.totalharga)
                                    if(response.btn){
                                        $('.btncheckout').prop('disabled',false)
                                    }else{
                                        $('.btncheckout').prop('disabled',true)
                                    }
                                    getDataSidebar()
                            }
                        }
                    })
                console.log(nilai);
             })

             $('.btncheckout').on('click',function () {
                 window.location.href="{{route('frontend.checkout.index')}}"
              })

             $(document).on('click','.qtybutton', function () {
                 var jumlah = $(this).siblings("input").val();
                 var id = $(this).siblings("input").data('id')
                 $tr = $(this).closest('tr');

                var subtotal =  $(this).closest("tr").find('.subtotal');

                ajax()
                $.ajax({
                    url:"{{route('frontend.keranjang.update_jumlah')}}",
                    method:"POST",
                    data:{
                        id:id,
                        jumlah:jumlah,
                    }, success:function(response){
                        if(response.status){
                            $('.totalharga').text('Total : '+response.totalharga)
                            subtotal.text(response.subtotal)

                                if(response.btn){
                                    $('.btncheckout').prop('disabled',false)
                                }else{
                                    $('.btncheckout').prop('disabled',true)
                                }
                                getDataSidebar()
                                if(response.hapus){
                                    location.reload(true)
                                }
                        }
                    }
                })
              })

             $('.btncheck').on('click', function () {
                 var id = $(this).data('id')
                 var nilai = $(this).is(":checked")
                 ajax()
                 $.ajax({
                     url:"{{route('frontend.keranjang.update_checkbox')}}",
                     method:"POST",
                     data:{
                         id:id,
                         nilai:nilai,
                         update:'one'
                     }, success:function(response){
                         if(response.status){
                                $('.totalharga').text('Total : '+response.totalharga)
                                if(response.btn){
                                    $('.btncheckout').prop('disabled',false)
                                }else{
                                    $('.btncheckout').prop('disabled',true)
                                }
                                getDataSidebar()
                                if(response.checked){
                                    $('#all').prop('checked','checked')
                                }else{
                                    $('#all').prop('checked',false)
                                }
                         }
                     }
                 })
              })

              $('.wishlist-cart').on('click', function(){
                    var id = $(this).data('id')

                    $.ajax({
                        url:"{{route('frontend.favorit.store')}}",
                        method:"POST",
                        data:{
                            id:id
                        },success:function(response){
                            if(response.status){
                                $('#data-alert-cart').html('<div class="alert alert-success" role="alert"> Produk berhasil di tambahkan ke favorit </div>')
                                setTimeout(function () { $('#data-alert-cart').empty() },1500)
                            }
                        }
                    })
                });

                // $('.pro-dec-big-img-slider').slick('unslick', $('.btn-wishlist').index());
        })
</script>
@endpush
