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
                            <a class="nav-link" href="#hero">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#about">About Us</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#timeline">Timeline</a>
                        </li>

                        <a class="navbar-brand d-none d-lg-block" href="/">
                            MIM
                            <strong class="d-block">Medev Indo Makmur</strong>
                        </a>

                        <li class="nav-item active">
                            <a class="nav-link" href="#ourproduct">Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#booking">Contact Us</a>
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

        <section class="hero" id="hero">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="landing/images/slider/foto-1.jpg" class="img-fluid" alt="">
                                </div>
                                <div class="carousel-item">
                                    <img src="landing/images/slider/young-asian-female-dentist-white-coat-posing-clinic-equipment.jpg"
                                        class="img-fluid" alt="">
                                </div>
                                <div class="carousel-item">
                                    <img src="landing/images/slider/foto-2.jpg" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="heroText d-flex flex-column justify-content-center">

                            <h1 class="mt-auto mb-2">
                                <div>It's all about care</div>
                                Better
                                <div class="animated-info">
                                    @foreach ($words as $item)
                                        <span class="animated-item">{{ $item }}</span>
                                    @endforeach
                                </div>
                            </h1>

                            <div class="heroLinks d-flex flex-wrap align-items-center">
                                <a class="custom-link me-0" href="#about" data-hover="Learn More">Learn More</a>

                                <p class="contact-phone mb-0"><i class="bi-phone"></i> 010-020-0340</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding" id="about">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-12">
                        <h2 class="mb-lg-3 mb-3">About Us</h2>

                        <p>{{ $aboutus }}</p>

                        <div style="margin-top: 50px;">
                            <h6>Vision</h6>
                            <p>To be the most integrated and reliable healthcare provider in Indonesia.</p>
                        </div>

                        <div style="margin-top: 10px;">
                            <h6>Mission</h6>
                            <p>To serve all our customers and persons that needed our service with CARE.</p>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-5 col-12 mx-auto">
                        <div
                            class="featured-circle bg-white shadow-lg d-flex justify-content-center align-items-center">
                            <p class="featured-text"><span class="featured-number">3</span> Years<br> of Experiences
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding pb-0" id="timeline">
            <div class="container">
                <div class="row">

                    <h2 class="text-center mb-lg-5 mb-4">Our Timeline</h2>

                    <div class="timeline">
                        <div
                            class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes">
                            <div
                                class="col-9 col-md-5 me-md-4 me-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                <h3 class=" text-light">2020</h3>

                                <p>PT Medev Indo Makmur was established as a distributor of Orthopedic and
                                    Cardiovascular products.</p>
                            </div>

                            <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                <i class="bi bi-building timeline-icon"></i>
                            </div>

                            <div class="col-9 col-md-5 ps-md-3 ps-lg-0 order-1 order-md-3 py-4 timeline-date">
                                {{-- <time>2021-05-18 Tuesday</time> --}}
                            </div>
                        </div>

                        <div
                            class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes">
                            <div
                                class="col-9 col-md-5 me-md-4 me-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                <h3 class=" text-light">2021</h3>

                                <p>Collaborate with new principals to distribute dental care products.</p>
                            </div>

                            <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                <i class="bi-link timeline-icon"></i>
                            </div>

                            <div class="col-9 col-md-5 ps-md-3 ps-lg-0 order-1 order-md-3 py-4 timeline-date">
                                {{-- <time>2021-07-31 Saturday</time> --}}
                            </div>
                        </div>

                        <div
                            class="row g-0 justify-content-end justify-content-md-around align-items-start timeline-nodes">
                            <div
                                class="col-9 col-md-5 me-md-4 me-lg-0 order-3 order-md-1 timeline-content bg-white shadow-lg">
                                <h3 class=" text-light">2022</h3>

                                <p>Improving service by providing consignment sales.</p>
                            </div>

                            <div class="col-3 col-sm-1 order-2 timeline-icons text-md-center">
                                <i class="bi-graph-up timeline-icon"></i>
                            </div>

                            <div class="col-9 col-md-5 ps-md-3 ps-lg-0 order-1 order-md-3 py-4 timeline-date">
                                {{-- <time>2021-07-31 Saturday</time> --}}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <section class="section-padding pb-0" id="ourproduct">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <h2 class="text-center mb-lg-5 mb-4">Products Division</h2>

                        <div class="owl-carousel reviews-carousel">


                            <figure class="reviews d-flex flex-wrap align-items-center">
                                <a href="/productsOT" class="text-primary text-center d-block mb-0 w-100">
                                    <strong>Orthopaedic</strong>
                                    <img src="landing/images/reviews/ot.png"
                                        style="height:250px; width: 250px; display: block; margin-left: auto; margin-right: auto;"
                                        class="mx-auto d-flex align-items-center" alt="asdasdsad">
                                </a>
                            </figure>
                            <figure class="reviews d-flex flex-wrap align-items-center">
                                <a href="/productsDC" class="text-primary text-center d-block mb-0 w-100">
                                    <strong>Dental Care</strong>
                                    <img src="landing/images/reviews/dc.png"
                                        style="height:250px; width: 250px; display: block; margin-left: auto; margin-right: auto;"
                                        class="mx-auto d-flex align-items-center" alt="asdasdsad">
                                </a>
                            </figure>
                            <figure class="reviews d-flex flex-wrap align-items-center">
                                <a href="/productsCV" class="text-primary text-center d-block mb-0 w-100">
                                    <strong>Cardiovascular</strong>
                                    <img src="landing/images/reviews/cv.png"
                                        style="height:250px; width: 250px; display: block; margin-left: auto; margin-right: auto;"
                                        class="mx-auto d-flex align-items-center" alt="asdasdsad">
                                </a>
                            </figure>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="section-padding" id="booking">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="booking-form">
                            <h6 class="text-center mb-lg-3 mb-2">If you have any inquiries regarding any of our
                                products or services, please fill in the following form:</h6>
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }} {{-- session success pada registercontroller --}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close">
                                    </button>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }} {{-- session success pada registercontroller --}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form role="form" action="/dashboard/customerprospects" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <input type="text" name="fname" id="fname" class="form-control"
                                            placeholder="First name" required>
                                        @error('fname')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <input type="text" name="lname" id="lname" class="form-control"
                                            placeholder="Last name" required>
                                        @error('lname')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Email address" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <input type="telephone" name="tlp" id="tlp" pattern="[0-9]{7,13}"
                                            class="form-control" placeholder="Phone: 08xxxxxxx/021xxxx" required>
                                        @error('tlp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" rows="5" id="message" name="message"
                                            placeholder="Additional message, must be less than 255 characters" required></textarea>
                                        @error('message')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-3 col-md-4 col-6 mx-auto">
                                        <button type="submit" class="form-control"
                                            onclick="return confirm('Are you sure to submit the form?')"
                                            id="submit-button">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="site-footer section-padding" id="information">
        <div class="container">
            <div class="row">

                {{-- <div class="col-lg-5 me-auto col-12">
                        <h5 class="mb-lg-4 mb-3">Opening Hours</h5>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                                Sunday : Closed
                            </li>

                            <li class="list-group-item d-flex">
                                Monday, Tuesday - Firday
                                <span>8:00 AM - 3:30 PM</span>
                            </li>

                            <li class="list-group-item d-flex">
                                Saturday
                                <span>10:30 AM - 5:30 PM</span>
                            </li>
                        </ul>
                    </div> --}}

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
