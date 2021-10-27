@extends('ecommerce.admin.master')
@section('title', 'Customer')
@section('title-nav', 'Customer')
@section('customer', 'class=active-sidebar')
@section('cssnav', 'cssnav')
@section('content')


<section class="section mt-4">
    
    <div class="section-body mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">

                        <table class="table table-hover" id="tablecust">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No Hp</th>
                                  
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


              $('#tablecust').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/id.json'
                },
              })


     })
</script>
@endpush
