@extends('backend.master')

@section('title', 'Print')
@section('title-nav', 'Print')
@section('cssnav', 'cssnav')
@section('content')
<style>
    .cssnav {
        margin-left: -25px;
    }

</style>
<style>
    .tinggi_card {
        height: 29.7cm
    }

    .right {
        text-align: right;
    }

    span.error {
        outline: none;
        border: 1px solid #800000;
        box-shadow: 0 0 5px 1px #800000;
    }
</style>
<div id="non-printable">
    <form id="formPrint" method="get" target="_blank" action="@if (auth()->user()->hasRole('production'))
        {{route('print.export')}}
        @elseif (auth()->user()->hasRole('warehouse'))
        {{route('warehouse.print.export')}}
    @endif">
        @csrf
        <input type="hidden" name="tipe" id="tipe">
        <section class="section mt-2">

            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <div id="data-error">

                                </div>
                                @include('backend.include.alert')

                                @csrf

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dari">Dari</label>
                                            <input type="date" class="form-control" required id="dari" name="dari">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sampai">Sampai</label>
                                            <input type="date" class="form-control" required id="sampai" name="sampai">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="menu">Menu</label>
                                            <select class="form-control" multiple id="menu" name="menu[]">

                                                @if (auth('web')->user()->hasRole('production'))
                                                <option value="CUTTING">CUTTING</option>
                                                <option value="TAILORING">TAILORING</option>
                                                <option value="REPAIR">REPAIR</option>
                                                <option value="WASHING">WASHING</option>
                                                <option value="TRASH">TRASH</option>
                                                <option value="RECAPITULATION">RECAPITULATION</option>
                                                @elseif(auth('web')->user()->hasRole('warehouse'))
                                                <option value="FINISHING">FINISHING</option>
                                                <option value="WAREHOUSE">WAREHOUSE</option>
                                                <option value="RETUR">RETUR</option>
                                                <option value="RECAPITULATION">RECAPITULATION</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary btnfilter"
                                            style="margin-top: 30px">Apply Filter</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-md-12 text-right">

                    <button type="button" class="btn btn-danger btndownload"><i class="ri-download-2-fill glyph"></i>
                        Download</button>

                    <button type="button" class="btn btn-primary btnprint"><i class="ri-printer-fill"></i>
                        Print</button>

                </div>
        </section>
    </form>
    <section class="section mt-4">
        <div class="section-body" style="overflow-y: scroll; height:400px;" id="dataprint">
            {{-- <div class="row" id="testdata"> --}}
            {{-- <div class="col-md-6">
                    <div class="card tinggi_card">

                        <div class="card-body">

                            <h5 class="card-title right mr-2">GARMENT</h5>

                            <hr>
                            <div class="row ml-2">
                                <div class="col-md-3">
                                    <span  class="btn btn-primary">Cutting</span>
                                </div>
                            </div>
                            <table class="table" >

                                <tbody>

                                </tbody>
                              </table>
                        </div>
                    </div>
                </div> --}}
            {{-- <div class="col-md-6">
                    <div class="card tinggi_card">

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div> --}}
            {{-- </div> --}}
        </div>
    </section>

</div>

@endsection
@if (auth()->user()->hasRole('production'))
@push('scripts')

<script>
    $(document).ready(function () {
            $('#menu').select2()


            $('.btndownload').on('click',function(){
                $('#tipe').val('download');
                $('#formPrint').submit()
            })


            $('.btnprint').on('click',function(){
                $('#tipe').val('print');
                $('#formPrint').submit()
            })

            $('.btnfilter').on('click', function(){
                var tes = $('#dataprint')
                var form = $('#formPrint').serialize()

                    $.ajax({
                    url:"{{route('print.index')}}",
                    method:"GET",
                    data:form,
                    success:function(data){
                        if(data.status){
                            var dataprint = data.print;
                            var htmldata = ''
                            dataprint.forEach((element,i) => {
                                if(i == 0){
                                    htmldata+= '<div class="row">'
                                }

                                if(i!=0 && i%2 == 0){
                                        // add end of row ,and start new row on every 3 elements
                                        htmldata += '</div><div class="row">'
                                }
                                        var data = element.data;
                                        var title = element.title;
                                        if(title != undefined){
                                            htmldata += '<div class="col-md-6"><div class="card tinggi_card"><div class="card-body"><h5 class="card-title right mr-2">GARMENT</h5><hr><div class="row ml-2"><div class="col-md-3"><span  class="btn btn-primary">'+element.icon+' '+element.menu+'</span></div></div><table class="table" ><tbody>'
                                            data.forEach((value, index) => {
                                                    htmldata += '<tr>'
                                                        htmldata += '<td style="text-align:left">' +title[index]+ '</td>'
                                                        htmldata += '<td class="right font-weight-bold">' +value+ '</td>'
                                                    htmldata += '</tr>'
                                            });

                                            htmldata += '</tbody></table></div></div></div>'
                                        }


                            });
                            htmldata += '</div>'
                            tes.html(htmldata)
                            $('#data-error').empty()
                        }else{
                            $('#data-error').html(data.data)
                        }

                    }
                })


            })
     })
</script>
@endpush
@elseif(auth()->user()->hasRole('warehouse'))
@push('scripts')

<script>
    $(document).ready(function () {
            $('#menu').select2()


            $('.btndownload').on('click',function(){
                $('#tipe').val('download');
                $('#formPrint').submit()
            })


            $('.btnprint').on('click',function(){
                $('#tipe').val('print');
                $('#formPrint').submit()
            })

            $('.btnfilter').on('click', function(){
                var tes = $('#dataprint')
                var form = $('#formPrint').serialize()

                    $.ajax({
                    url:"{{route('warehouse.print.index')}}",
                    method:"GET",
                    data:form,
                    success:function(data){
                        if(data.status){
                            var dataprint = data.print;
                            var htmldata = ''
                            dataprint.forEach((element,i) => {
                                if(i == 0){
                                    htmldata+= '<div class="row">'
                                }

                                if(i!=0 && i%2 == 0){
                                        // add end of row ,and start new row on every 3 elements
                                        htmldata += '</div><div class="row">'
                                }
                                        var data = element.data;
                                        var title = element.title;
                                        if(title != undefined){
                                            htmldata += '<div class="col-md-6"><div class="card tinggi_card"><div class="card-body"><h5 class="card-title right mr-2">GARMENT</h5><hr><div class="row ml-2"><div class="col-md-3"><span  class="btn btn-primary">'+element.icon+' '+element.menu+'</span></div></div><table class="table" ><tbody>'
                                            data.forEach((value, index) => {
                                                    htmldata += '<tr>'
                                                        htmldata += '<td>' +title[index]+ '</td>'
                                                        htmldata += '<td class="right font-weight-bold">' +value+ '</td>'
                                                    htmldata += '</tr>'
                                            });

                                            htmldata += '</tbody></table></div></div></div>'
                                        }


                            });
                            htmldata += '</div>'
                            tes.html(htmldata)
                            $('#data-error').empty()
                        }else{
                            $('#data-error').html(data.data)
                        }

                    }
                })


            })
     })
</script>
@endpush
@endif
