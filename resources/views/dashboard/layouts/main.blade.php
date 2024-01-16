<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SI-MIM | {{ $title }}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="../../../assets/img/icon.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Fonts and icons -->
    <script src="../../../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Open+Sans:300,400,600,700"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
                urls: ['../../../assets/css/fonts.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <style>
        /* Gaya untuk kelas btn-gray */
        .btn-back {
            background-color: #9c9090;
            color: #fff;
        }
    </style>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/azzara.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../../../assets/css/demo.css">
</head>

<body>
    <div class="wrapper">
        <!--
   Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
  -->
        <div class="main-header" data-background-color="dark">
            @include('dashboard.layouts.header')
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-background"></div>
            <div class="sidebar-wrapper scrollbar-inner">
                @include('dashboard.layouts.sidebar')
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <!--   Core JS Files   -->
                    <script src="../../../assets/js/core/jquery.3.2.1.min.js"></script>
                    <script src="../../../assets/js/core/popper.min.js"></script>
                    <script src="../../../assets/js/core/bootstrap.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


                    <!-- jQuery UI -->
                    <script src="../../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
                    <script src="../../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

                    <!-- jQuery Scrollbar -->
                    <script src="../../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

                    <!-- Moment JS -->
                    <script src="../../../assets/js/plugin/moment/moment.min.js"></script>

                    <!-- Chart JS -->
                    <script src="../../../assets/js/plugin/chart.js/chart.min.js"></script>

                    <!-- jQuery Sparkline -->
                    <script src="../../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

                    <!-- Chart Circle -->
                    <script src="../../../assets/js/plugin/chart-circle/circles.min.js"></script>

                    <!-- Datatables -->
                    <script src="../../../assets/js/plugin/datatables/datatables.min.js"></script>

                    <!-- Bootstrap Notify -->
                    <script src="../../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

                    <!-- Bootstrap Toggle -->
                    <script src="../../../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

                    <!-- jQuery Vector Maps -->
                    <script src="../../../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
                    <script src="../../../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

                    <!-- Google Maps Plugin -->
                    <script src="../../../assets/js/plugin/gmaps/gmaps.js"></script>

                    <!-- Sweet Alert -->
                    <script src="../../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

                    <!-- Azzara JS -->
                    <script src="../../../assets/js/ready.min.js"></script>
                    @yield('isibody')
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<!-- Azzara DEMO methods, don't include it in your project! -->

</html>
