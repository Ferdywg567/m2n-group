<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &dash; Garmen</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/nestable/css/nestable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap-datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/modules/datatables/dataTables.dateTime.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/basic.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropzone.min.css')}}">
    <style>
        .btn-primary {
            background-color: #007AFF;
        }

        .btn-outline-primary {
            border-color: #007AFF;
            color: #007AFF;
        }


        .active-sidebar {
            background-color: rgba(0, 123, 255, 0.3);
            border-radius: 8px;
            margin-left: 5px;
            margin-right: 5px;
        }

        .active-sidebar a {
            color: #007AFF !important;
        }

        th {
            font-size: 10px;
            text-align: center;
        }

        td {
            text-align: center;
            font-size: 12px;
        }

        td span {
            font-size: 10px !important;
        }

        body {
            font-family: 'Heebo', serif;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            {{-- <div class="navbar-bg" style="background-color: white"></div> --}}
            <nav class="navbar navbar-expand-lg main-navbar" style="background-color: white" id="non-printable">
                @include('ecommerce.admin.include.topnav')
            </nav>
            <div class="main-sidebar sidebar-style-2" id="non-printable">
                @include('ecommerce.admin.include.sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer" id="non-printable">
                @include('ecommerce.admin.include.footer')
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}?{{ uniqid() }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{ asset('assets/modules/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nestable/js/jquery.nestable.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery.mask.js')}}"></script>
    <script src="{{ asset('assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.min.js')}}"></script>
    {{-- <script src="{{asset('js/dropzone-amd-module.min.js')}}"></script> --}}
    <script src="{{asset('js/dropzone.min.js')}}"></script>
    
    @include('backend.include.toastr')

    @stack('scripts')

    <script>

        $(document).ready(function () {
            $('.nicescroll-rails.nicescroll-rails-vr').remove();
            $(".do-nicescrol").niceScroll("{horizrailenabled:false}");
            // $('#btnnotif').on('click',function () {
            //     $.ajax({
            //         url:"{{route('notification')}}",
            //         method:"GET",
            //         success:function(data){
            //             if(data.status){
            //                 $('#btnnotif').removeClass('beep');
            //             }
            //         }
            //     })
            // })

            // $('.notif-item').on('click', function () {
            //     var id = $(this).data('id')
            //     $.ajax({
            //         url:"{{route('notification.readklik')}}",
            //         method:"GET",
            //         data:{
            //             'id':id
            //         }
            //     })
            //  })


        })
    </script>
</body>

</html>
