<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="../../../landing/css/bootstrap.min.css" rel="stylesheet">

    <link href="../../../landing/css/bootstrap-icons.css" rel="stylesheet">

    <link href="../../../landing/css/owl.carousel.min.css" rel="stylesheet">

    <link href="../../../landing/css/owl.theme.default.min.css" rel="stylesheet">

    <link href="../../../landing/css/templatemo-medic-care.css" rel="stylesheet">
    <!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
    <style>
        /* CSS untuk mengubah warna aktif menjadi hijau */
        .breadcrumb .breadcrumb-item.active {
            color: rgb(120, 120, 247);
        }
    </style>
</head>

<body id="top">

    <main>

        <nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
            <div class="container">
                <a class="navbar-brand mx-auto d-lg-none" href="/">
                    MIM
                    <strong class="d-block">Medev Indo Makmur</strong>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/#hero">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/#about">About Us</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/#timeline">Timeline</a>
                        </li>

                        <a class="navbar-brand d-none d-lg-block" href="/">
                            MIM
                            <strong class="d-block">Medev Indo Makmur</strong>
                        </a>

                        <li class="nav-item active">
                            <a class="nav-link" href="/#ourproduct">Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/#booking">Contact Us</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#information">Contact</a>
                        </li>
                    </ul>
                </div>
                <div>
                    @auth
                        <a href="/dashboard">Dashboard</a>
                    @else
                        <a href="/login">Login</a>
                    @endauth
                </div>
            </div>
        </nav>
        <div class="container"style="margin-top: 3%">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/#ourproduct">Product</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $division }}</li>
                </ol>
            </nav>
        </div>

        <div class="container" style="margin-top: 2%">
            <h2 class="mb-lg-3 mb-3">{{ $title }}</h2>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="background-image">
                        <img style="height: 250px;" src="landing/images/product/dc/optradam.jpeg" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-6" style="margin-top: 11%">
                    <H3>Optradam Plus</H3>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="background-image">
                        <img style="height: 150px;" src="landing/images/product/dc/optragate.jpeg" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-6" style="margin-top: 5%">
                    <H3>Optragate</H3>
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="background-image">
                        <img style="height: 150px;" src="landing/images/product/dc/tetric.jpeg" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-6" style="margin-top: 1%">
                    <H3>Tetric n Cream</H3>
                </div>
            </div>
        </div>
    </main>

    <footer class="site-footer section-padding" id="information">
        <div class="container">
            <div class="row">


                <div class="col-lg-2 col-md-6 col-12 my-4 my-lg-0">
                    <h5 class="mb-lg-4 mb-3">Head Office</h5>

                    <p>Komplek Perkantoran Duta Merlin Blok B 46-47, Jl. Gajah Mada B 46-47, Jakarta Pusat</p>
                    <p>E. <br><a href="mailto:mim@medev.com">mim@medev.com</a>
                    <p>
                    <p>T. <br><a>021-6335378</a>
                    <p>
                </div>

                <div class="col-lg-3 col-md-6 col-12 ms-auto">
                    <h5 class="mb-lg-4 mb-3">Socials</h5>

                    <ul class="social-icon">
                        <li><a href="#" class="social-icon-link bi-facebook"></a></li>

                        <li><a href="#" class="social-icon-link bi-twitter"></a></li>

                        <li><a href="#" class="social-icon-link bi-instagram"></a></li>

                        <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-12 ms-auto mt-4 mt-lg-0">
                    <p class="copyright-text">Copyright © Medic Care 2021
                        <br><br>Design: <a href="https://templatemo.com" target="_parent">Okka Dharma</a>
                    </p>
                </div>

            </div>
            </section>
    </footer>

    <!-- JAVASCRIPT FILES -->
    <script src="landing/js/jquery.min.js"></script>
    <script src="landing/js/bootstrap.bundle.min.js"></script>
    <script src="landing/js/owl.carousel.min.js"></script>
    <script src="landing/js/scrollspy.min.js"></script>
    <script src="landing/js/custom.js"></script>
    <!--

TemplateMo 566 Medic Care

https://templatemo.com/tm-566-medic-care

-->
</body>

</html>
