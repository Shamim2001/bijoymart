<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta type="hidden" name="csrf-token" id="token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/images/icons/favicon.png') }}">
    <title>Bijoy Mart | @yield('title')</title>
    <!--plugins-->
    {{-- <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" /> --}}
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    {{-- <link href="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" /> --}}
    <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="../../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.9.1/font/bootstrap-icons.css"> --}}
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- loader-->
    <link href="{{ asset('backend') }}/assets/css/pace.min.css" rel="stylesheet" />

    <!--Theme Styles-->
    {{-- <link href="{{ asset('backend') }}/assets/css/dark-theme.css" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('backend') }}/assets/css/light-theme.css" rel="stylesheet" /> --}}
    <link href="{{ asset('backend') }}/assets/css/semi-dark.css" rel="stylesheet" />
    {{-- <link href="{{ asset('backend') }}/assets/css/header-colors.css" rel="stylesheet" /> --}}
    <link href="{{ asset('backend') }}/assets/css/custom.css" rel="stylesheet" />

    @stack('css')

</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        @include('admin.layouts.partials.top-header')
        <!--end top header-->

        <!--start sidebar -->
        @include('admin.layouts.partials.sidemenu')

        <!--end sidebar -->

        <!--start content-->
        <main class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Tables</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    {{-- <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!--end breadcrumb-->
            @yield('content')


        </main>
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

    </div>
    <!--end wrapper-->


    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    {{-- <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    {{-- <script src="{{ asset('backend') }}/assets/plugins/easyPieChart/jquery.easypiechart.js"></script> --}}
    {{-- <script src="{{ asset('backend') }}/assets/plugins/peity/jquery.peity.min.js"></script> --}}
    {{-- <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script> --}}
    {{-- <script src="{{ asset('backend') }}/assets/js/pace.min.js"></script> --}}
    {{-- <script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script> --}}
    {{-- <script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script> --}}
    {{-- <script src="{{ asset('backend') }}/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script> --}}
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    {{-- <script src="{{ asset('backend') }}/assets/plugins/notifications/js/notifications.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/notifications/js/notification-custom-script.js"></script> --}}

    <script src="{{ asset('backend') }}/assets/js/table-datatable.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/form-select2.js"></script>
    <!--app-->
    <script src="{{ asset('backend') }}/assets/js/app.js"></script>
    <script src="{{ asset('backend') }}/assets/js/index.js"></script>
    @stack('js')
    {{-- <script>
        new PerfectScrollbar(".best-product")
        new PerfectScrollbar(".top-sellers-list")
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif

        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
    </script>

</body>

</html>
