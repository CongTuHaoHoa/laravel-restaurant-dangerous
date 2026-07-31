<div class="d-flex align-items-center gap-2">

    <!-- Search -->
    <button id="navSearchBtn" class="btn btn-outline-light btn-sm" title="Search">
        <i class="fas fa-search"></i>
    </button>

    @guest
        <!-- Login -->
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
            <i class="fas fa-sign-in-alt me-1"></i> Login
        </a>

        <!-- Register -->
        <a href="{{ route('register') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-user-plus me-1"></i> Register
        </a>
    @else
        <!-- User -->
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
                    <a class="dropdown-item" href="{{ route('home') }}">
                        Dashboard
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        Logout
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
    @endguest

    <!-- Order -->
    <a href="#menu" class="nav-link nav-cta">
        <i class="fas fa-shopping-bag me-1"></i>
        Order Now
    </a>

    <!-- Cart -->
    <a href="{{ route('cart.index') }}"
       class="btn btn-outline-warning btn-sm position-relative">

        <i class="fas fa-shopping-cart"></i>

        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ session('cart') ? count(session('cart')) : 0 }}
        </span>

    </a>

</div>