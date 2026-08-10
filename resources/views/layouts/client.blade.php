<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Sarab">
    <meta name="description" content="Sarab - Fast Food & Restaurant HTML Template">
    <title>@yield('title', 'Sarab - Fast Food & Restaurant HTML Template')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet"/>
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.9.0/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-9DZ6o3pJWcTwBR8W196XizUEf2kNMD35tkeyWqOB0yzml+nZrEe/13PMCpAIrT4r" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.9.0/dist/js/coreui.bundle.min.js" integrity="sha384-FTek6QoTuxz6Bb078pS0kYQ0qH2LZVB5LWwZl8944mluH+TCk0q3OP4PqA+dHJRl" crossorigin="anonymous"></script>
    <link href="{{ asset('/css/client/bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- AOS Animate on Scroll -->
    <link href="{{ asset('/css/client/aos.css') }}" rel="stylesheet"/>
    <!-- Swiper -->
    <link href="{{ asset('/css/client/swiper-bundle.min.css') }}" rel="stylesheet"/>
    <!-- all min css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{ asset('/css/client/magnific-popup.css') }}"/>
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('/css/client/style.css') }}"/>

</head>
<body>
<!-- ============================================================
   TOP BAR
   ============================================================ -->
<div id="topbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="top-contact d-flex flex-wrap">
                <span><i class="fas fa-phone-alt"></i>(+84) 12 345 6789</span>
                <span><i class="fas fa-envelope"></i>Restaurant@dangerousplace.com</span>
                <span><i class="fas fa-map-marker-alt"></i>123 Quang Trung, TP.HCM</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="ttag"><i class="fas fa-fire me-1"></i>Free Delivery Today!</span>
                <div class="tsoc">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================
   NAVBAR
   ============================================================ -->
<nav class="navbar navbar-expand-lg" id="nav">
    <div class="container">
        <a class="navbar-brand" href="#">
            <div class="blogo">
                <div class="bico"><i class="fas fa-utensils"></i></div>
                <div>
                    <div class="bname">Sar<span>ab</span></div>
                    <div class="bsub">Fast Food & Restaurant</div>
                </div>
            </div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <i class="fas fa-bars" style="color:var(--primary);font-size:1.35rem;"></i>
        </button>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="{{ route('client.index') }}#hero">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('client.index') }}#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('client.index') }}#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('client.index') }}#chefs">Chefs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('client.index') }}#reservation">Reservation</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('client.index') }}#testimonials">Reviews</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('client.index') }}#contact-section">Contact</a></li>
            </ul>
            <div class="d-flex align-items-center gap-2">

    <div class="d-flex align-items-center gap-2">

                <button id="navSearchBtn" title="Search">
                    <i class="fas fa-search"></i>
                </button>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                @else
                    <div class="dropdown">
                        <button
                            class="btn btn-warning btn-sm dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-user me-1"></i>
                            {{ Auth::user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item" href="{{ route('client.index') }}">
                                    <i class="fas fa-home me-2"></i> Dashboard
                                </a>
                            </li>

                            @if(Auth::user()->role == 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">
                                        <i class="fas fa-user-shield me-2"></i> Admin Dashboard
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a class="dropdown-item" href="{{ route('myaccount.index') }}">
                                    <i class="fas fa-user-circle me-2"></i>
                                    My Account
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item text-danger"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </a>
                            </li>

                        </ul>

                        <form id="logout-form"
                            action="{{ route('logout') }}"
                            method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    </div>

                    <a href="{{ route('cart.index') }}" class="btn btn-outline-warning btn-sm position-relative">
                        <i class="fas fa-shopping-cart"></i>

                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ array_sum(session('foods', [])) }}
                        </span>
                    </a>
                @endguest
            </div>
        </div>
    </div>
    </div>
</nav>
<!-- ============================================================
   FIX 1 � SEARCH OVERLAY POPUP
   ============================================================ -->
<form action="{{ route('search.index') }}" method="GET">
    <div id="searchOv">
        <button class="sovclose" id="searchClose"><i class="fas fa-times"></i></button>
        <div class="sovbox">
            <h4>What are you craving today?</h4>
            <div class="sovinput">
                <input 
                    name="search"
                    value="{{ request('search') }}" 
                    placeholder="Search burgers, pizza, chicken..." autocomplete="off"/>
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            <!-- Categories inside search box -->
            <div class="sovcats">
            
            </div>
        
        </div>
    </div>
</form>

@yield('content')

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="fnm">Sar<span>ab</span></div>
                <p class="fdesc">We bring the world's finest flavors together in a fast, friendly, and affordable experience. Every meal crafted with love.</p>
                <div class="fsoc">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="ftit">Quick Links</div>
                <ul class="flinks ps-0">
                    <li><a href="#hero"><i class="fas fa-chevron-right"></i>Home</a></li>
                    <li><a href="#about"><i class="fas fa-chevron-right"></i>About Us</a></li>
                    <li><a href="#menu"><i class="fas fa-chevron-right"></i>Our Menu</a></li>
                    <li><a href="#reservation"><i class="fas fa-chevron-right"></i>Reservation</a></li>
                    <li><a href="#blog"><i class="fas fa-chevron-right"></i>Blog</a></li>
                    <li><a href="#contact-section"><i class="fas fa-chevron-right"></i>Contact</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="ftit">Our Menu</div>
                <ul class="flinks ps-0">
                    <li><a href="#menu"><i class="fas fa-chevron-right"></i>Burgers</a></li>
                    <li><a href="#menu"><i class="fas fa-chevron-right"></i>Pizza</a></li>
                    <li><a href="#menu"><i class="fas fa-chevron-right"></i>Fried Chicken</a></li>
                    <li><a href="#menu"><i class="fas fa-chevron-right"></i>Wraps &amp; Rolls</a></li>
                    <li><a href="#menu"><i class="fas fa-chevron-right"></i>Pasta</a></li>
                    <li><a href="#menu"><i class="fas fa-chevron-right"></i>Desserts</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <div class="ftit">Get In Touch</div>
                <div class="fci">
                    <div class="fciico"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="fciinfo"><strong>Address</strong>42 Flavor Street, Manhattan, NY 10001</div>
                </div>
                <div class="fci">
                    <div class="fciico"><i class="fas fa-phone-alt"></i></div>
                    <div class="fciinfo"><strong>Phone</strong>+1 (800) 123-4567</div>
                </div>
                <div class="fci">
                    <div class="fciico"><i class="fas fa-envelope"></i></div>
                    <div class="fciinfo"><strong>Email</strong>hello@sarabfood.com</div>
                </div>
                <div class="fci">
                    <div class="fciico"><i class="fas fa-clock"></i></div>
                    <div class="fciinfo"><strong>Hours</strong>Wed - Sun: 09 AM - 11 PM</div>
                </div>
            </div>
        </div>
    </div>
    <div class="fbot">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <p>&copy 2026 <span>Sarab Restaurant</span>. All Rights Reserved by
                    <a target="_blank" class="mx-0 fw-bold text-success" href="https://bestwpware.com/">Bestwpware</a>. Made with
                    <span><i class="fas fa-heart"></i></span> <br>Distributed by
                    <a target="_blank" class="mx-0 fw-bold text-success" href="https://themewagon.com">ThemeWagon</a>
                </p>
                <div><a href="#">Privacy Policy</a><a href="#">Terms</a><a href="#">Cookies</a></div>
            </div>
        </div>
    </div>
</footer>
<!-- Floating cart -->
<!-- <div class="cartfl"><i class="fas fa-shopping-cart"></i><span>My Cart</span><div class="ccount" id="cartCount">0</div></div> -->
<!-- Back to top -->
<button id="btt" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="fas fa-chevron-up"></i></button>

<!-- jQuery -->
<script src="{{ asset('js/client/jquery-3.7.1.min.js') }}"></script>
<!-- Bootstrap 5 -->
<script src="{{ asset('js/client/bootstrap.bundle.min.js') }}"></script>
<!-- AOS -->
<script src="{{ asset('js/client/aos.js') }}"></script>
<!-- Swiper -->
<script src="{{ asset('js/client/swiper-bundle.min.js') }}"></script>
<!-- CounterUp -->
<script src="{{ asset('js/client/jquery.magnific-popup.min.js') }}"></script>
<!-- Main js -->
<script src="{{ asset('js/client/main.js') }}"></script>
</body>
</html>
