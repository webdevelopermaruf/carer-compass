<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Compass</title>
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/mobile.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{asset('/assets/css/owl.carousel.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/assets/css/owl.theme.default.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <style>
        .avatar {
            width: 80px;
            height: 80px;
            background-color: #f0f0f0; /* Light background */
            color: #333;               /* Dark letter color */
            font-size: 36px;
            font-weight: bold;
            font-family: Arial, sans-serif;
            border-radius: 50%;        /* Makes it circular */
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ddd;    /* Optional soft border */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
    @yield('css')
</head>

<body>

<!-- Top-Header-Section -->
<div class="home-header-section home-header-section1" >
    <!--Header-Section -->
    <header class="header">
        <div class="main-header">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <a href="/"><img src="{{asset('assets/images/logo.png')}}" style="max-width: 150px" alt="" class="img-fluid"></a>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon navbar-toggler-icon2"></span>
                        <span class="navbar-toggler-icon navbar-toggler-icon2"></span>
                        <span class="navbar-toggler-icon navbar-toggler-icon2"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown sancare-li-color active">
                                <a class="nav-link  active" href="/">Home</a>
                            </li>
                            @if(auth()->user())
                                <li class="nav-item">
                                    <a class="nav-link text-decoration-none navbar-text-color index2-navlink"
                                       href="/dashboard">Dashboard</a>
                                </li>
                            @endif
                            @if(auth()->guard('parent')->user() || auth()->guard('carer')->user() || auth()->user())
                                <li class="nav-item">
                                    <a class="nav-link text-decoration-none navbar-text-color index2-navlink"
                                       href="/logout">Logout</a>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link text-decoration-none navbar-text-color index2-navlink"
                                       href="/login">Login</a>
                                </li>
                                <li class="nav-item list-unstyled  btn-talk nav-btn2">
                                    <a class="nav-link" href="/register-as-parent">Register as a Parent</a></li>
                                <li class="nav-item list-unstyled  btn-talk nav-btn2">
                                    <a class="nav-link" href="/register-as-carer">Register As a Carer</a></li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    @yield('hero')
</div>
@yield('page')
<!-- Footer -->
<div class="footer-section footer-img-section footer-index-img position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <figure class="sencare-logo-footer" style="margin-bottom: 0;">
                    <a class="navbar-brand mr-0" href="index.html"><img src="assets/images/logo.png" style="max-width: 150px" alt=""
                                                                        class="img-fluid"></a>
                </figure>
                <p class="footer-text">Copyright &copy; 2025 Carer-Compass. All Rights reserved</p>
                <div class="social-icons text-center">
                    <ul class="list-unstyled">
                        <li><a href="index.html" class="text-decoration-none"><i
                                    class="fa-brands fa-twitter social-networks"></i></a></li>
                        <li><a href="index.html" class="text-decoration-none"><i
                                    class="fa-brands fa-facebook-f social-networks"></i></a></li>
                        <li><a href="index.html" class="text-decoration-none"><i
                                    class="fa-brands fa-pinterest-p social-networks"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-2 col-sm-12 d-lg-block d-none">
                <ul class="list-unstyled footer-list-ul">
                    <li class="list-item footer-margin-left">
                        <h4 class="footer-link  footer-heading">
                            Useful Links
                        </h4>
                    </li>
                    <li>
                        <a href="/" class="text-decoration-none footer-link-p">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/login" class="text-decoration-none footer-link-p">
                            Login
                        </a>
                    </li>
                    <li>
                        <a href="/login-as-parent" class="text-decoration-none footer-link-p">
                            Register as a Parent
                        </a>
                    </li>
                    <li>
                        <a href="/login-as-carer" class="text-decoration-none footer-link-p">
                            Register as a Carer
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <ul class="list-unstyled footer-list-ul contact-info-heading">
                    <li class="list-item footer-margin-left">
                        <h4 class="footer-link footer-heading">
                            Contact Info
                        </h4>
                    </li>
                    <li class="footer-margin-bottom">
                        <a href="#" class="text-decoration-none">
                            Address:
                        </a>
                    </li>
                    <li class="pr-2 mb-3">
                        <a class="text-decoration-none">
                            Huddersfield, United Kingdom
                        </a>
                    </li>
                    <li class="footer-margin-bottom">
                        <a class="text-decoration-none">
                            Email:
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="mailto:info@carer-compass.com" class="text-decoration-none">
                            info@carer-compass.com
                        </a>
                    </li>

                    <li class="footer-margin-bottom">
                        <a href="https://html.designingmedia.com/sencare/Find-Dealer.html"
                           class="text-decoration-none">
                            Phone:
                        </a>
                    </li>
                    <li>
                        <a href="tel:+123456789" class="text-decoration-none">
                            +1 23 45 6789
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <ul class="list-unstyled">
                    <li class="list-item">
                        <h4 class="footer-link  footer-heading instagram-heading">
                            Social
                        </h4>
                    </li>
                </ul>
                <div class="footer-images">
                    <div class="images-inner-box">
                        <ul class="list-unstyled mb-1">
                            <li class="list-item d-inline-block">
                                <figure class="mb-0"><img
                                        src="https://html.designingmedia.com/sencare/assets/images/footer-img1.png"
                                        alt="Snow" class="img-fluid footer-imgs"></figure>
                            </li>
                            <li class="list-item d-inline-block">
                                <figure class="mb-0"><img src="assets/images/footer-img2.png" alt="Snow"
                                                          class="img-fluid footer-imgs"></figure>
                            </li>
                            <li class="list-item d-inline-block">
                                <figure class="mb-0"><img src="assets/images/footer-img3.png" alt="Snow"
                                                          class="img-fluid footer-imgs"></figure>
                            </li>
                        </ul>
                    </div>
                    <div class="images-inner-box">
                        <ul class="list-unstyled">
                            <li class="list-item d-inline-block">
                                <figure class="mb-0"><img src="assets/images/footer-img4.png" alt="Snow"
                                                          class="img-fluid footer-imgs"></figure>
                            </li>
                            <li class="list-item d-inline-block">
                                <figure class="mb-0"><img src="assets/images/footer-img5.png" alt="Snow"
                                                          class="img-fluid footer-imgs"></figure>
                            </li>
                            <li class="list-item d-inline-block">
                                <figure class="mb-0"><img src="assets/images/footer-img6.png" alt="Snow"
                                                          class="img-fluid footer-imgs"></figure>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="{{asset('assets/js/animations.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<script src="{{asset('assets/js/custom-script.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.js')}}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{asset('assets/js/text-animations.js')}}"></script>
<script src="{{asset('assets/js/carousel.js')}}"></script>
<script src="{{asset('assets/js/video-section.js')}}"></script>
@yield('js')
</body>

</html>
