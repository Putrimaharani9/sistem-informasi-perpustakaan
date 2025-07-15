<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', $pageTitle . ' - ' . getSetting('app_name'))</title>
    <link rel="shortcut icon" href="/img/{{ getSetting('app_icon') }}" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="/css/custom-dataTables.css">

    @stack('metatags')
    @stack('style')

    <style>
        label {
            color: black;
        }

        .text--black {
            color: black;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('partials.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div>
                @include('partials.topbar')
                <div id="content" style="opacity: 0; min-height: 100vh">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('partials.scroll-to-up')

    @include('partials.firebase')

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    {{-- <script src="vendor/chart.js/Chart.min.js"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> --}}

    <script src="/js/dataTables.min.js"></script>

    <!-- Sweetalert 2 -->
    <script src="/vendor/sweetalert2@11.js"></script>


    @stack('scripts')

    <script>
        $(document).ready(function() {
            $("#content").animate({
                opacity: 1
            }, 800);
        })
    </script>
</body>

</html>
