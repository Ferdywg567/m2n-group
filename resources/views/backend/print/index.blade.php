@extends('backend.master')

@section('title', 'Bahan')

@section('bahan', 'class=active')

@section('content')
<style>
    .tinggi_card{
        height: 29.7cm
    }

    .right{
        text-align: right;
    }
</style>
<div id="non-printable">
    <section class="section">
        <div class="section-header ">
            <a class="btn btn-primary" href="{{route('bahan.index')}}">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="ml-2">PRINT | Data</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            @include('backend.include.alert')
                            <form id="formBahanMasuk">
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
                                            <select class="form-control" multiple id="menu">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btnfilter" style="margin-top: 30px">Apply Filter</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
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
@push('scripts')
<script>
    $(document).ready(function () {
            $('#menu').select2()

            $('.btnfilter').on('click', function(){
                var tes = $('#dataprint')
                $.ajax({
                    url:"{{route('print.index')}}",
                    method:"GET",
                    success:function(data){
                        console.log(data);
                        var dataprint = data.print;
                        var htmldata = ''
                        dataprint.forEach((element,i) => {
                            if(i == 0){
                                htmldata+= '<div class="row">'
                            }
                                    var data = element.data;
                                    var title = element.title;
                                     htmldata += '<div class="col-md-6"><div class="card tinggi_card"><div class="card-body"><h5 class="card-title right mr-2">GARMENT</h5><hr><div class="row ml-2"><div class="col-md-3"><span  class="btn btn-primary">'+element.menu+'</span></div></div><table class="table" ><tbody>'
                                        data.forEach((value, index) => {
                                                htmldata += '<tr>'
                                                    htmldata += '<td>' +title[index]+ '</td>'
                                                    htmldata += '<td class="right font-weight-bold">' +value+ '</td>'
                                                htmldata += '</tr>'
                                        });

                                    htmldata += '</tbody></table></div></div></div>'
                                    if(i!=0 && i%3 == 0){
                                    // add end of row ,and start new row on every 3 elements
                                    htmldata += '</div><div class="row">'
                                    }
                        });
                        htmldata += '</div>'
                        tes.html(htmldata)
                    }
                })
            })
     })
</script>
@endpush
